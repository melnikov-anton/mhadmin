FROM debian:stable
RUN apt-get update && apt-get install -y apache2 php php-mysql mariadb-server \
proftpd mc sudo curl python3-pip libapache2-mod-wsgi-py3 && a2enmod rewrite \
&& usermod -aG sudo www-data && rm -rf /var/lib/apt/lists/*
COPY ./sudoers.d/www-data /etc/sudoers.d
ENTRYPOINT service apache2 start && mysql_install_db && service mysql start && service proftpd start \
 && chmod 0440 /etc/sudoers.d/www-data && chown root:root /etc/sudoers.d/www-data && bash
