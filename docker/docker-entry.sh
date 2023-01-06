#!/bin/sh
set -e


php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

php composer.phar require --dev orm-fixtures
php composer.phar install

## Symfony configuration
if [ ${APP_ENV} != "prod" ]; then
  php bin/console doctrine:database:drop --force --quiet --if-exists --no-interaction
fi
php bin/console doctrine:database:create --if-not-exists --quiet --no-interaction
php bin/console doctrine:migrations:migrate --verbose --no-interaction --allow-no-migration
if [ ${APP_ENV} != "prod" ]; then
  php bin/console doctrine:fixtures:load --quiet --no-interaction --no-debug
fi

php bin/console cache:clear
php bin/console cache:warmup

chmod -R 777 /var/www/var
chmod -R 777 /var/www/public

## server config
php-fpm -D &
nginx -g "daemon off;"