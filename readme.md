##Vagrant instalation:

Note on Error while attempting to mount NFS synced folders:

vagrant NFS requires a host-only network to be created. Please add a host-only network to the machine (with either DHCP or a static IP) for NFS to work.

- Temporary solution: Removed NFS

## Install LAMP stack for PHP7:
https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04

## Laravel Pre-Reqs:
    apt install php7.0-zip
    sudo apt-get install php7.0-mbstring
    sudo apt-get install php-xml

## Install/Configure Laravel 5.3:
https://laravel.com/docs/5.3/installation

## Note on MySQL remote connections:
I like not having mysql passwords locally. So during the mysql-server setup, I chose a blank password. Turns out this triggers a mysql plugin to kick in and you won't be able to use mysql with your vagrant user. Not sure if this is unique to the latest Ubuntu version, but I don't think it happened in 12.x

The following fixes the issue and removes any password preset by the plugin:
Source: http://askubuntu.com/a/801950

1. sudo mysql -uroot

2. ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';

3. You might have to update the 'bind-address' field in your my.cnf file to allow remote connections. In Ubuntu 16.x that file is at: /etc/mysql/mysql.conf.d/mysqld.cnf

    bind-address        = 0.0.0.0

4. Now connecting from Sequel Pro goes as usual:

    MySQL Host: 127.0.0.1
    Username: root
    Password:
    Database:
    Port:
    SSH Host: 192.168.59.76
    SSH User: vagrant
    SSH Key: ~/.vagrant.d/insecure_private_key


