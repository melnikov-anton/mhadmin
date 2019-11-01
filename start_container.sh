#!/usr/bin/env bash

CURR_DIR=`pwd`
#Change path
WORK_DIR="/Dokumente/diplom"

docker build -t debianenv:mha $CURR_DIR
docker run -it -p 8090:80 -p 8091:81 -p 3306:3306 -p 21:21 -p 20:20 -p 25000-25005:25000-25005 \
-v $WORK_DIR/www/mhadmin/docker/mysql:/var/lib/mysql \
-v $WORK_DIR/www:/var/www \
-v $WORK_DIR/www/mhadmin/config/proftpd/conf.d:/etc/proftpd/conf.d \
-v $WORK_DIR/sites-enabled:/etc/apache2/sites-enabled \
debianenv:mha
