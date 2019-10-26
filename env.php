<?php

define('DEBUG', true);
//-------------------------------
define('APACHE_SITES_ENABLED_DIR', '/etc/apache2/sites-enabled');
define('VHOST_TEMPLATE_FILE', 'vhost_template.conf');
define('ADMIN_EMAIL', 'admin@mhadmin.local');
define('PROFTPD_USERFILE_DIR', '/var/www/mhadmin/config/proftpd');
define('PROFTPD_USER_FILE', 'mhadmin.passwd');
//======================================================================
//скрипты
define('ARCHIVE_SITE_SCRIPT', 'archive_site_dir.sh');
define('DELETE_SITE_SCRIPT', 'delete_site_dir.sh');
define('CREATE_FTP_SCRIPT', 'create_ftp_access.sh');

// настройки базы данных
define('DB_NAME', 'mhadmin_db');
define('DB_USER', 'mhadmin');
define('DB_PASSWORD', 'mhadmin');
define('DB_HOST', '127.0.0.1');
