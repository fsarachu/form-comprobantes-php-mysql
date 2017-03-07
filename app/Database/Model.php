<?php

namespace App\Database;

use PDO;

abstract class Model
{
  protected static $table = null;
  protected static $db = null;
  protected $exists = null;

  public function __construct()
  {
    if (!static::$db) {
      $pdo_options = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::ATTR_PERSISTENT => true
      );

      static::$db = new PDO(
        DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        $pdo_options
      );
    }
  }

  abstract public function save();

  abstract public function delete();

  public static function all()
  {
    $sql = "SELECT * FROM " . static::$table;
    $query = static::$db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public static function get($id)
  {
    $sql = "SELECT * FROM " . static::$table . " WHERE id = :id LIMIT 1";
    $query = static::$db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }
}
