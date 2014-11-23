#!/usr/bin/env bash

sudo apt-get update
sudo apt-get install -y ruby mercurial php5-intl
gem install sass

echo I am: $(whoami)

echo "Following gems are installed:"
gem list

sudo rm -fr /etc/apache2/sites-enabled/000-default.conf
sudo ln -sf /var/www/conf/apache-vagrant.conf /etc/apache2/sites-enabled/010-jugendstadtplan.conf

# Backend installieren
cd /var/www 
composer install
php ./vendor/sensio/distribution-bundle/Sensio/Bundle/DistributionBundle/Resources/bin/build_bootstrap.php
php app/console doctrine:database:create -qn
php app/console doctrine:schema:update --force

# Dateirecht fuer npm korrekt setzen
sudo chown -R vagrant:vagrant /home/vagrant/.npm

# Frontend installieren
cd /var/www/frontend
mkdir build
npm install
bower install
grunt -f build

## mod_proxy aktivieren, damit die Rewrites fuer das Backend funktionieren
sudo a2enmod proxy
sudo a2enmod proxy_http

sudo apache2ctl restart
