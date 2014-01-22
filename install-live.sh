#!/bin/sh

WWW_USER=www-data
WWW_GROUP=www-data

### Bootstrap-Caching
touch app/bootstrap.php.cache

chown -R $WWW_USER:$WWW_GROUP app/bootstrap.php.cache
chown -R $WWW_USER:$WWW_GROUP app/cache
chown -R $WWW_USER:$WWW_GROUP app/logs


