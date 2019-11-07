#!/usr/bin/env bash

#apt update -y
apt-get update && apt-get install -y apache2 php php-mysql mariadb-server \
proftpd mc curl python3-pip libapache2-mod-wsgi-py3 && a2enmod rewrite

mysql < config/mysql/mhadmin_db_init.sql
