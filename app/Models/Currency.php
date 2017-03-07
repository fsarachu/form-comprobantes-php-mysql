<?php


namespace App\Models;


use App\Core\Model;


class Currency extends Model
{
  protected static $table = 'currencies';
  private $name = null;
  private $code = null;
  private $symbol = null;

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
    $this->validate();

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
}
