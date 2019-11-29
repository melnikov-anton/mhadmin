#!/usr/bin/env bash

#Изменить на путь к директории, в которой находится директория mhadmin
WORK_DIR="/Dokumente/diplom/www"

cd $WORK_DIR/mhadmin/docker
CURR_DIR=`pwd`

docker build -t debianenv:mha $CURR_DIR
docker run -it -p 8090:80 -p 8091:81 -p 3306:3306 -p 21:21 -p 20:20 -p 25000-25005:25000-25005 \
-v $WORK_DIR/mhadmin/docker/mysql:/var/lib/mysql \
-v $WORK_DIR/mhadmin/docker/sites-enabled:/etc/apache2/sites-enabled \
-v $WORK_DIR:/var/www \
-v $WORK_DIR/mhadmin/config/proftpd/conf.d:/etc/proftpd/conf.d \
debianenv:mha
