#!/bin/sh

WWW_USER=www
WWW_GROUP=www


#### Composer
if [ -f /opt/local/share/composer/bin/composer ];
then
    COMPOSER_EXECUTABLE=/opt/local/share/composer/bin/composer
else
    COMPOSER_EXECUTABLE=$(which composer)
fi

sudo $COMPOSER_EXECUTABLE install

### Node Package Manager
cd web/spa
npm install


### Bower
bower install

### Grunt
grunt build

cd -
### Bootstrap-Caching
sudo touch app/bootstrap.php.cache

sudo chown -R $WWW_USER:$WWW_GROUP app/bootstrap.php.cache
sudo chown -R $WWW_USER:$WWW_GROUP app/cache
sudo chown -R $WWW_USER:$WWW_GROUP app/logs


