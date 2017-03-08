<?php


namespace App\Models;


use App\Core\Model;
use Joelvardy\Flash;

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
    // Start with no errors
    $errors = [];

    // Sanitize
    $this->name = trim($this->name);
    $this->code = strtoupper(trim($this->code));
    $this->symbol = trim($this->symbol);

    // Validate
    if (!strlen($this->name)) {
      $errors[] = 'Nombre de la moneda requerido';
    }

    if (!preg_match('/^[A-Z]{3}$/', $this->code)) {
      $errors[] = 'El código de la moneda debe de ser de exactamente 3 caracteres';
    }

    if (!strlen($this->symbol)) {
      $errors[] = 'Símbolo de la moneda requerido';
    }

    // Return errors
    return $errors;
  }

  public function save()
  {
    $errors = $this->validate();

    if (count($errors)) {
      foreach ($errors as $msg) {
        Flash::message('error', $msg);
      }

      throw new \Exception('ValidationError');
    }

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
