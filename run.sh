#!/bin/bash

if [ ! -e './vendor' ]
then
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    php ./composer.phar install
fi
vendor/bin/phpunit --bootstrap vendor/autoload.php --configuration phpunit.xml && \
php ./main.php