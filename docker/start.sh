#!/bin/bash

#版本号更新
cd /var/www/html/app/service/ && php version_update

su - nobody -c "php /var/www/html/app/service/artisan cache:clear"
su - nobody -c "php /var/www/html/app/service/artisan view:clear"


#重新运行nginx
nginx
nginx -s reload
