#!/bin/bash

if [ ! -e './vendor' ]
then
    composer install && \ 
    vendor/bin/phpunit --bootstrap vendor/autoload.php --configuration phpunit.xml
fi
php ./main.php