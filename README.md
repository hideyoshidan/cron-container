# cron-container
## ■ Overview
This repository is for batch and testing cron.  
Container list is following.

|container name|description|
| ------------- | ------------- |
|larave_nginx|For web-server|
|larave_mysql|For database-server|
|larave_php|For php|
|larave_cron|For cron|

`laravel_cron` container allows to execute any cmd on other containers.  
Although `laravel_cron` execute cmd on others, it is need to use cmds as docker cmd.  
```
<!-- format -->
docker exec [container name] base -c '[any cmd]'

<!-- sample -->
docker exec laravel_php bash -c 'cd ./cron-test-app; php artisan batch:sample'
```
This means cmd must be oneliner.

## ■ Why is it possible to access on `laravel_cron` to other containers?
Host machine has `/var/run/docker.sock`.  
As mount its file to the container, the container is available to operate other containers.



## ■ Cron setting  
First of all, `laravel_cron` is for cron.  
cron's setting file is "./larave_cron/crontabs/cron_test".  
Please maintenance cron jobs on cron_test.  

### Sample Step: 
1. make any file on other containers.

2. write its schedule on cron_test file.
```
<!-- sample -->
* * * * * for i in `seq 0 10 59`;do (sleep ${i} ; docker exec laravel_php bash -c 'cd ./cron-test-app; php artisan batch:sample') & done > /test/sample.txt;
```
3. run following cmd in laravel_cron container
```
$ crontab /etc/crontabs/cron_test
```


## ■ What I referred Link
> [【Docker】crond専用のコンテナからHTTPリクエストを送ったり他コンテナのコマンドを実行してみたりする【cron】](https://qiita.com/samunohito/items/784e3e0aea4b7390f70c#%E5%AE%9A%E6%9C%9F%E7%9A%84%E3%81%AB%E5%88%A5%E3%82%B3%E3%83%B3%E3%83%86%E3%83%8A%E3%81%AE%E3%82%B3%E3%83%9E%E3%83%B3%E3%83%89%E3%82%92%E5%AE%9F%E8%A1%8C%E3%81%97%E3%81%A6%E3%81%BF%E3%82%8B)