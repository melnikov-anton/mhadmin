#!/usr/bin/env bash

apt update -y

mysql < config/mysql/mhadmin_db_init.sql
