php composer.phar dump-autoload
php artisan clear-compiled
php artisan dump-autoload
php artisan cache:clear
php artisan optimize
rm app/storage/sessions/*
rm app/storage/views/*
rm app/storage/logs/*
dos2unix nbprojects/project.properties.xml
dos2unix nbprojects/project.xml
dos2unix robots.txt
#chmod -R 755 *
#chown -R www-data:www-data *
php artisan routes
