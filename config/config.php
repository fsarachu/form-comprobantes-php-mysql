<?php
define('BASE_URL', 'http://comprobantes.dev/');
define('UPLOAD_DIR', 'public/uploads');
define('UPLOAD_URL', 'uploads/');
define('ENVIRONMENT', 'development');

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'comprobantes_app');
define('DB_USER', 'comprobantes_app');
define('DB_PASS', 'secret');
define('DB_CHARSET', 'utf8');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
}

session_start();
