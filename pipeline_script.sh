#!/bin/bash

# heads up tg notif
cd /var/www/html/backend-api && chmod +x exec_tg_prenotif.sh
cd /var/www/html/backend-api && ./exec_tg_prenotif.sh


# initiate updates
cd /var/www/html/backend-api && git pull
cd /var/www/html/backend-api && php artisan migrate
cd /var/www/html/backend-api && composer install --no-interaction
cd /var/www/html/backend-api && chmod +x pipeline_script.sh


# done tg notif
cd /var/www/html/backend-api && chmod +x exec_tg_notif.sh
cd /var/www/html/backend-api && ./exec_tg_notif.sh
