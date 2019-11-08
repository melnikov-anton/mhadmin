#!/usr/bin/env bash

CURR_DIR=`pwd`

#apt update -y
apt-get update && apt-get install -y apache2 php php-mysql mariadb-server \
proftpd mc curl python3-pip libapache2-mod-wsgi-py3
a2enmod rewrite

mysql < config/mysql/mhadmin_db_init.sql

cp config/proftpd/mhadmin.passwd.init config/proftpd/mhadmin.passwd
chmod 0440 config/proftpd/mhadmin.passwd
chown www-data:www-data config/proftpd/mhadmin.passwd

cp config/sudoers.d/www-data /etc/sudoers.d/www-data
chmod 0440 /etc/sudoers.d/www-data

ln -sf $CURR_DIR/config/apache2/mhadmin.conf /etc/apache2/sites-enabled/mhadmin.conf

ln -sf $CURR_DIR/config/proftpd/conf.d/mhadmin.conf /etc/proftpd/conf.d/mhadmin.conf

chown www-data:www-data archive vhosts
chown -R www-data:www-data public config


service apache2 restart
service proftpd restart
