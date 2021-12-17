# 公式版でもたぶんOK
FROM alpine:latest


# 必要パッケージの取得とタイムゾーンの変更処理（Asia/Tokyo）
RUN apk --update add tzdata && \
    cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    apk del tzdata && \
    rm -rf /var/cache/apk/*

# dockerのバイナリを取得し、クライアントのみを/usr/local/binへコピー
RUN apk add --no-cache ssl_client && \
  mkdir -p /usr/local/bin && \
  wget https://get.docker.com/builds/Linux/x86_64/docker-latest.tgz -O - | tar -xzC /usr/local/bin --strip=1 docker/docker

# あらかじめ用意しておいたcrontabs用ファイルをコンテナへコピーする
RUN mkdir -p /var/spool/cron/crontabs
COPY ./crontabs/cron_test /var/spool/cron/crontabs/cron_test

CMD busybox crond -l 2 -L /dev/stderr -f