<?php


namespace App\Models;


use App\Core\Model;


class Currency extends Model
{
  protected static $table = 'currencies';
  private $id = null;
  private $name = null;
  private $code = null;
  private $symbol = null;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getCode()
  {
    return $this->code;
  }

  public function setCode($code)
  {
    $this->code = $code;
  }

  public function getSymbol()
  {
    return $this->symbol;
  }

  public function setSymbol($symbol)
  {
    $this->symbol = $symbol;
  }

  public function validate()
  {
    null;
  }

  public function save()
  {
    if ($this->id) {
      $sql = 'UPDATE ' . static::$table . ' SET name = :name, code = :code, symbol = :symbol WHERE id = :id';
      $parameters = array(
        ':id' => $this->id,
        ':name' => $this->name,
        ':code' => $this->code,
        ':symbol' => $this->symbol
      );
    } else {
      $sql = 'INSERT INTO ' . static::$table . ' (`name`, `code`, `symbol`) VALUES (:name, :code, :symbol)';
      $parameters = array(
        ':name' => $this->name,
        ':code' => $this->code,
        ':symbol' => $this->symbol
      );
    }

    $query = $this->db->prepare($sql);
    $query->execute($parameters);
  }

  public function delete()
  {
    $sql = 'DELETE FROM ' . static::$table . ' WHERE id = :id';
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $this->id);
    $query->execute($parameters);
  }

}
