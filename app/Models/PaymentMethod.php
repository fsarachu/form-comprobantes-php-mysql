<?php


namespace App\Models;


use App\Core\Model;

class PaymentMethod extends Model
{
  protected static $table = 'payment_methods';
  private $name;


  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function validate()
  {
    // Start with no errors
    $errors = [];

    // Sanitize
    $this->name = trim($this->name);

    // Validate
    if (!strlen($this->name)) {
      $errors[] = 'Nombre del método requerido';
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

      throw new Exception('ValidationError');
    }

    if ($this->id) {
      $sql = 'UPDATE ' . static::$table . ' SET name = :name WHERE id = :id';
      $parameters = array(
        ':id' => $this->id,
        ':name' => $this->name
      );
    } else {
      $sql = 'INSERT INTO ' . static::$table . ' (`name`) VALUES (:name)';
      $parameters = array(
        ':name' => $this->name
      );
    }

    $query = $this->db->prepare($sql);
    $query->execute($parameters);
  }
}
