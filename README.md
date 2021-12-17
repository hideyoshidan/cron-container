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


## ■ Cron setting  
First of all, `laravel_cron` is for cron.  
cron's setting file is "./larave_cron/crontabs/cron_test".  
Please maintenance cron jobs on cron_test.  

### Sample Step: 
1. make any file

2. write its schedule on cron_test file.
```
<!-- sample -->
* * * * * for i in `seq 0 10 59`;do (sleep ${i} ; docker exec laravel_php bash -c 'cd ./cron-test-app; php artisan batch:sample') & done > /test/sample.txt;
```
3. run following cmd in laravel_cron container
```
$ crontab /etc/crontabs/cron_test
```

