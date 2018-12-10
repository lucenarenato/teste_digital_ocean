#!/bin/bash



# sudo chmod -R php_serve_8000

sudo chmod -R 777 storage
echo "Iniciar Servidor PHP"

#hoje=$(date +%d%m%Y)
data=$(date +"%T, %d/%m/%y, %A")
echo "$data"

echo "Versão do PHP"
php -v
echo "*** localhost ***"
php -S localhost:8000 -t public

#php artisan serve





#echo -e '<?php
#echo "Viva o Linux!";
#?>'

#sudo su apache (or www-data)
#cd /var/www
#sh ./myscript

