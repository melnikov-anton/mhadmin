FROM debian:stable
RUN apt-get update && apt-get install -y apache2 php php-mysql mariadb-server \
proftpd mc curl python3 libapache2-mod-wsgi && a2enmod rewrite && rm -rf /var/lib/apt/lists/*
ENTRYPOINT service apache2 start && mysql_install_db && service mysql start && service proftpd start \
 && bash
