<?php

// настройки базы данных
define('DB_NAME', 'mhadmin_db');
define('DB_USER', 'mhadmin');
define('DB_PASSWORD', 'mhadmin');
define('DB_HOST', '127.0.0.1');
//-------------------------------
define('APACHE_SITES_ENABLED_DIR', '/etc/apache2/sites-enabled');
//-------------------------------
define('DEFAULT_CONTROLLER', 'Home');

//сообщения об ошибках
define('MSG_404', 'Ресурс не найден!');
define('MSG_DB_ERR', 'Ошибка базы данных!');
define('MSG_USERINDB_ERR', 'Пользователь не найден!');
define('MSG_LOG_ERR', 'Имя пользователя или пароль не правильные!');
define('MSG_REG_ERR', 'Ошибка при регистрации пользователя!');
define('MSG_SITEREG_ERR', 'Ошибка при регистрации сайта!');

//сообщения об успехе
define('MSG_REG_SUC', 'Успешная регистрация пользователя!');
define('MSG_SITEREG_SUC', 'Успешная регистрация сайта!');
