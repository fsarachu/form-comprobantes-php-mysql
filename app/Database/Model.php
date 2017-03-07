<?php

namespace App\Database;


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
    $sql = "SELECT * FROM " . static::$table;
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public static function get($id)
  {
    $db = ConnectionFactory::create();
    $sql = "SELECT * FROM " . static::$table . " WHERE id = :id LIMIT 1";
    $query = $db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }
}
