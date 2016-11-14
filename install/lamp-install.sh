#!/bin/bash

echo Ubuntu 16.04 LAMP installer
echo Optimized for Laravel 5.3

echo "Installing Apache"
sudo apt-get update
sudo apt-get install apache2
sudo apache2ctl configtes
sudo systemctl restart apache2
sudo ufw app list
sudo ufw app info "Apache Full"
sudo ufw allow in "Apache Full"
sudo a2enmod rewrite
echo

echo IP Address
ip addr show eth0 | grep inet | awk '{ print $2; }' | sed 's/\/.*$//'
echo

echo "Installing MySQL"
sudo apt-get install mysql-server
echo

echo "Installing PHP"
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql php7.0-zip php7.0-mbstring php-xml
echo

echo "Installing composer and other utilities"
apt install composer
apt install multitail

echo "Configuring git"
git config --global core.editor vim

sudo systemctl restart apache2
sudo systemctl status apache2
