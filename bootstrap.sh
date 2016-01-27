#!/usr/bin/env bash

sudo apt-get update
sudo apt-get install -y mercurial php5-intl

# NFS performance-boost
sudo apt-get install cachefilesd
sudo chmod 666 /etc/default/cachefilesd
sudo echo "RUN=yes" >> /etc/default/cachefilesd
sudo /etc/init.d/cachefilesd restart

echo I am: $(whoami)

sudo rm -fr /etc/apache2/sites-enabled/000-default.conf
sudo ln -sf /var/www/conf/vagrant/api.jugendstadtplan.dev.conf /etc/apache2/sites-enabled/010-api.jugendstadtplan.dev.conf
sudo ln -sf /var/www/conf/vagrant/www.jugendstadtplan.dev.conf /etc/apache2/sites-enabled/010-www.jugendstadtplan.dev.conf

# Backend installieren
cd /var/www
composer install
php ./vendor/sensio/distribution-bundle/Sensio/Bundle/DistributionBundle/Resources/bin/build_bootstrap.php
php app/console doctrine:database:create -qn
php app/console doctrine:schema:update --force

# Dateirecht fuer npm korrekt setzen
sudo chown -R vagrant:vagrant /home/vagrant/.npm

# Frontend installieren
cd /var/www
npm install
bower install
gulp

sudo apache2ctl restart
