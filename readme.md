## Instalation

0. Prerequisites: Vagrant >= 1.8.6 + Virtual Box >= 5.1

1. Clone this repo

2. Configure your hosts file to include the following line. Both of these values are configurable in Vagrantfile and install/lamp-install.sh

    ```
    192.168.59.76 fs.dev
    ```

3. This step may take a while, depending on whether you have the needed bento/ubuntu-16.04 image already cached with vagrant.

    Run:

    ```
    vagrant up
    ```

4. You're done! Point your browser to fs.dev

# Old Installation notes

## Installation for Ubuntu 16.04

1. A LAMP installer bash script is located at 'install/lamp-install.sh'. It installs everything needed for this app to run.

    From the cli, run:

    ```
    sudo ./install/lamp-install.sh
    ```

2. After cloning this repo, configure it by running:

    ```
    composer update
    sudo chgrp -R www-data storage bootstrap/cache
    sudo chmod -R ug+rwx storage bootstrap/cache
    ```


3. Your vhost should look something like this:

    ```
    <VirtualHost *:80>
        ServerAdmin fredduarte@gmail.com
        ServerName www.fs.freddyduarte.com
        ServerAlias fs.freddyduarte.com

        DocumentRoot /var/www/fs/public
        <Directory "/var/www//fs/public">
            AllowOverride All
        </Directory>
    </VirtualHost>
    ```


4. Your '.env' file (located in the app's root) should look something like this:


    ```
    APP_ENV=production
    APP_KEY=base64:MrsNlt8fGSnCmrWU122BtjgFxsIVumOqFCCAf9I2MJQ=
    APP_DEBUG=false
    APP_LOG_LEVEL=debug
    APP_URL=http://fs.freddyduarte.com

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=fs
    DB_USERNAME=root
    DB_PASSWORD=

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    SESSION_DRIVER=file
    QUEUE_DRIVER=sync

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_DRIVER=smtp
    MAIL_HOST=mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null

    PUSHER_APP_ID=
    PUSHER_KEY=
    PUSHER_SECRET=
    ```


5. Create a MySQL DB called 'fs' (or whatever you defined in .env) and execute the migrations by running:


    ```
    php artisan migrate
    ```


## Note on MySQL (remote) connections:
I like not having mysql passwords locally. So during the mysql-server setup, I chose a blank password. Turns out this triggers a mysql plugin to kick in and you won't be able to use mysql with your vagrant user. Not sure if this is unique to the latest Ubuntu version, but I don't think it happened in 12.x

You may see this error while running the migrations:


    SQLSTATE[HY000] [1698] Access denied for user 'root'@'localhost'


The following fixes the issue and removes any password preset by the plugin:

Source: http://askubuntu.com/a/801950

1. sudo mysql -uroot

2. ``` ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY ''; ```

3. You might have to update the 'bind-address' field in your my.cnf file to allow remote connections. In Ubuntu 16.x that file is at: /etc/mysql/mysql.conf.d/mysqld.cnf

    bind-address        = 0.0.0.0

4. Now connecting from Sequel Pro goes as usual:

    ```
    MySQL Host: 127.0.0.1
    Username: root
    Password:
    Database:
    Port:
    SSH Host: 192.168.59.76
    SSH User: vagrant
    SSH Key: ~/.vagrant.d/insecure_private_key
    ```


The steps above should conclude the installation of this app.

#### Local Vagrant instalation:

Note on Error while attempting to mount NFS synced folders:

    "vagrant NFS requires a host-only network to be created. Please add a host-only network to the machine (with either DHCP or a static IP) for NFS to work."

Temporary solution: Removed NFS

#### Digital Ocean Install LAMP stack for PHP7:

https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04

#### Install/Configure Laravel 5.3:

[https://laravel.com/docs/5.3/installation](https://laravel.com/docs/5.3/installation)

