#!/usr/bin/env bash

SUDOERS_DIR='/etc/sudoers.d'
SUDOERS_FILE='/etc/sudoers'
MUST_DIR='/var/www/mhadmin'
cd $MUST_DIR
CURR_DIR=`pwd`

echo "Создание базы данных для mhadmin."
mysql < config/mysql/mhadmin_db_init.sql

echo "Настройка mhadmin."
cp config/proftpd/mhadmin.passwd.init config/proftpd/mhadmin.passwd
chmod 0440 config/proftpd/mhadmin.passwd
chown www-data:www-data config/proftpd/mhadmin.passwd

cp config/sudoers.d/www-data $SUDOERS_DIR/www-data
chmod 0440 $SUDOERS_DIR/www-data

ln -sf $CURR_DIR/config/apache2/mhadmin.conf /etc/apache2/sites-enabled/mhadmin.conf

chown www-data:www-data archive vhosts
chown -R www-data:www-data public config

# Отключение режима отладки
sed -i 's/\(.*DEBUG.*\)true/\1false/' ./env.php

echo "Перезагрузка служб."
service apache2 restart
service proftpd restart
service mysql restart
