<?php

namespace App\Core;

use App\Database\ConnectionFactory;
use PDO;

abstract class Model
{
  protected static $table = null;
  protected $db = null;
  protected $exists = null;

  public function __construct()
  {
    $this->db = ConnectionFactory::create();
  }

  abstract public function save();

  abstract public function delete();

  public static function all()
  {
    $db = ConnectionFactory::create();
    $sql = "SELECT * FROM " . static::$table . ' ORDER BY id';
    $query = $db->prepare($sql);
    $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());
    $query->execute();

    return $query->fetchAll();
  }

  public static function get($id)
  {
    $db = ConnectionFactory::create();
    $sql = "SELECT * FROM " . static::$table . " WHERE id = :id LIMIT 1";
    $query = $db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());
    $query->execute($parameters);

    return $query->fetch();
  }
}
