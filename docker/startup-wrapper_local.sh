# Required by maatwebsite/excel
sudo apk add php82-xmlreader

composer install
php artisan migrate --force

php artisan storage:link

chmod +x /scripts/scheduler.sh
/scripts/scheduler.sh &

sudo chgrp -R sindria /var/www/app/
sudo chmod -R 775 /var/www/app/storage/

sudo chmod +x /usr/local/bin/startup.sh
/usr/local/bin/startup.sh