<?php

//скрипты
define('ARCHIVE_SITE_SCRIPT', 'archive_site_dir.sh');
define('DELETE_SITE_SCRIPT', 'delete_site_dir.sh');
define('CREATE_FTP_SCRIPT', 'create_ftp_access.sh');

// настройки базы данных
define('DB_NAME', 'mhadmin_db');
define('DB_USER', 'mhadmin');
define('DB_PASSWORD', 'mhadmin');
define('DB_HOST', '127.0.0.1');
//-------------------------------
define('APACHE_SITES_ENABLED_DIR', '/etc/apache2/sites-enabled');
define('VHOST_TEMPLATE_FILE', 'vhost_template.conf');
define('ADMIN_EMAIL', 'admin@mhadmin.local');
//-------------------------------
define('DEFAULT_CONTROLLER', 'Home');

//сообщения об ошибках
define('MSG_404', 'Ресурс не найден!');
define('MSG_DB_ERR', 'Ошибка базы данных!');
define('MSG_USERINDB_ERR', 'Пользователь не найден!');
define('MSG_LOG_ERR', 'Имя пользователя или пароль не правильные!');
define('MSG_REG_ERR', 'Ошибка при регистрации пользователя!');
define('MSG_SITEREG_ERR', 'Ошибка при регистрации сайта!');
define('MSG_SITEDEL_ERR', 'Ошибка удаления сайта!');
define('MSG_RESTR_ERR', 'Нет доступа!');
define('MSG_PASSNOTEVEN_ERR', 'Введенные пароли не совпадают!');
//сообщения об успехе
define('MSG_REG_SUC', 'Успешная регистрация пользователя!');
define('MSG_SITEREG_SUC', 'Успешная регистрация сайта!');
define('MSG_CHANGE_SUC', 'Данные пользователя успешно изменены!');
define('MSG_PASSCHANGE_SUC', 'Пароль пользователя успешно изменен!');
define('MSG_CHANGESITE_SUC', 'Данные сайта успешно изменены!');
define('MSG_DELETESITE_SUC', 'Данные сайта успешно удалены!');
define('MSG_CHANGETYPE_SUC', 'Тип пользователя успешно изменен!');
define('MSG_CREATEDB_SUC', 'База данных успешно создана!');
