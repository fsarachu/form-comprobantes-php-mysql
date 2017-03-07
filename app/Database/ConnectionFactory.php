<?php


namespace App\Database;

use PDO;

class ConnectionFactory
{
  private static $pdo_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::ATTR_PERSISTENT => true
  ];

  public static function create()
  {
    return new PDO(
      DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
      DB_USER,
      DB_PASS,
      self::$pdo_options
    );
  }
}
