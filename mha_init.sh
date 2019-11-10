#!/usr/bin/env bash

CURR_DIR=`pwd`
SUDOERS_DIR='/etc/sudoers.d'
SUDOERS_FILE='/etc/sudoers'
MUST_DIR='/var/www/mhadmin'

if [[ "$CURR_DIR" != "$MUST_DIR" ]]
  then
    echo "Приложение mhadmin должно располагаться в директории /var/www !"
    echo "Данный скрипт должен находиться в директории /var/www/mhadmin !"
    exit 1
  fi

echo "Для корректной работы приложения mhadmin необходимо разрешить \
пользователю www-data (пользователь, от имени которого работает веб-сервер) \
выполнять некоторые команды от имени суперпользователя."
if [ -f "$SUDOERS_FILE" ]
  then
    echo "Команда sudo доступна."
  else
    echo "Установка sudo."
    apt-get update
    apt-get install -y sudo
    usermod -aG sudo www-data
  fi

echo "Установка необходимых программ."
apt-get update
apt-get install -y apache2 php php-mysql mariadb-server \
proftpd mc python3-pip libapache2-mod-wsgi-py3
a2enmod rewrite

echo "Создание базы данных для mhadmin."
mysql < config/mysql/mhadmin_db_init.sql

echo "Настройка mhadmin."
cp config/proftpd/mhadmin.passwd.init config/proftpd/mhadmin.passwd
chmod 0440 config/proftpd/mhadmin.passwd
chown www-data:www-data config/proftpd/mhadmin.passwd

cp config/sudoers.d/www-data $SUDOERS_DIR/www-data
chmod 0440 $SUDOERS_DIR/www-data

ln -sf $CURR_DIR/config/apache2/mhadmin.conf /etc/apache2/sites-enabled/mhadmin.conf

ln -sf $CURR_DIR/config/proftpd/conf.d/mhadmin.conf /etc/proftpd/conf.d/mhadmin.conf

chown www-data:www-data archive vhosts
chown -R www-data:www-data public config

# Отключение режима отладки
sed -i 's/\(.*DEBUG.*\)true/\1false/' ./env.php

echo "Перезагрузка служб."
service apache2 restart
service proftpd restart
service mysql restart
