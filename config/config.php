<?php
define('BASE_URL', 'http://comprobantes.dev/');
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
}

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'comprobantes_app');
define('DB_USER', 'comprobantes_app');
define('DB_PASS', 'secret');
define('DB_CHARSET', 'utf8');

session_start();
