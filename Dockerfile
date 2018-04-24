FROM dongen/php-nginx-alpine:71

LABEL maintainer="Wangzd <wangzhoudong@foxmail.com>"


#nginx 配置
RUN mkdir -p /var/www/html/app/service

# copy in code
ADD service /var/www/html/app/service

RUN rm -Rf etc/nginx/conf.d/*

ADD docker/nginx/conf.d/service.conf /etc/nginx/conf.d/service.conf

RUN rm -Rf /var/www/html/app/service/storage/framework/cache/*
RUN rm -Rf /var/www/html/app/service/storage/framework/sessions/*
RUN rm -Rf /var/www/html/app/service/storage/framework/views/*
RUN rm -Rf /var/www/html/app/service/storage/logs/*
RUN chmod -Rf 777 /var/www/html/app/service/storage
RUN chmod -Rf 777 /var/www/html/app/service/bootstrap


RUN sed -i -e "s/nobody:\/:\/sbin\/nologin/nobody:\/:\/bin\/sh/g" /etc/passwd


#自动任务
RUN echo "* * * * * su - nobody -c \"php /var/www/html/app/service/artisan schedule:run\"  >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root

#追加进程
ADD docker/supervisord.conf /etc/supervisor/conf.d/app-supervisord.conf
RUN cat /etc/supervisor/conf.d/app-supervisord.conf >> /etc/supervisor/conf.d/supervisord.conf

RUN su - nobody -c "php /var/www/html/app/service/artisan clear-compile"
RUN su - nobody -c "php /var/www/html/app/service/artisan optimize"


ADD docker/start.sh /start.sh
RUN chmod 755 /start.sh

EXPOSE 9001

#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/shop-supervisord.conf"]
