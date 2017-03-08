<?php


namespace App\Models;


use App\Core\Model;

class Invoice extends Model
{
  protected static $table = 'invoices';

  private $invoice_date = null;
  private $payment_method = null;
  private $payment_method_obj = null;
  private $currency = null;
  private $currency_obj = null;
  private $amount = null;
  private $description = null;
  private $image = null;
  private $signed_by_business = false;
  private $submitted_at = null;

  public function getInvoiceDate()
  {
    return $this->invoice_date;
  }

  public function setInvoiceDate($invoice_date)
  {
    $this->invoice_date = $invoice_date;
  }

  public function getPaymentMethod()
  {
    return $this->payment_method;
  }

  public function setPaymentMethod($payment_method)
  {
    $this->payment_method = $payment_method;
  }

  public function getPaymentMethodObj()
  {
    if (!$this->payment_method_obj) {
      $this->payment_method_obj = PaymentMethod::get($this->payment_method);
    }

    return $this->payment_method_obj;
  }

  public function getCurrency()
  {
    return $this->currency;
  }

  public function setCurrency($currency)
  {
    $this->currency = $currency;
  }

  public function getCurrencyObj()
  {
    if (!$this->currency_obj) {
      $this->currency_obj = Currency::get($this->currency);
    }

    return $this->currency_obj;
  }

  public function getAmount()
  {
    return $this->amount;
  }

  public function setAmount($amount)
  {
    $this->amount = $amount;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function getImage()
  {
    return $this->image;
  }

  public function setImage($image)
  {
    $this->image = $image;
  }

  public function isSignedByBusiness()
  {
    return $this->signed_by_business;
  }

  public function setSignedByBusiness($signed_by_business)
  {
    $this->signed_by_business = $signed_by_business;
  }

  public function getSubmittedAt()
  {
    return $this->submitted_at;
  }

  public function setSubmittedAt($submitted_at)
  {
    $this->submitted_at = $submitted_at;
  }

  public function validate()
  {
    // TODO: Implement validate() method.
  }

  public function save()
  {
    $this->validate();

    if ($this->id) {
      $sql = 'UPDATE ';
      $sql .= static::$table . ' ';
      $sql .= 'SET invoice_date = :invoice_date, description = :description, currency = :currency, ';
      $sql .= 'amount = :amount, payment_method = :payment_method, signed_by_business = :signed_by_business, ';
      $sql .= 'image = :image ';
      $sql .= 'WHERE id = :id';
      $parameters = array(
        ':id' => $this->id,
        ':invoice_date' => $this->invoice_date,
        ':description' => $this->description,
        ':currency' => $this->currency,
        ':amount' => $this->amount,
        ':payment_method' => $this->payment_method,
        ':signed_by_business' => $this->signed_by_business,
        ':image' => $this->image
      );
    } else {
      $sql = 'INSERT INTO `invoices` ';
      $sql .= '(`invoice_date`, `description`, `currency`, `amount`, `payment_method`, `signed_by_business`, `image`) ';
      $sql .= 'VALUES (:invoice_date, :description, :currency, :amount, :payment_method, :signed_by_business, :image)';
      $parameters = array(
        ':invoice_date' => $this->invoice_date,
        ':description' => $this->description,
        ':currency' => $this->currency,
        ':amount' => $this->amount,
        ':payment_method' => $this->payment_method,
        ':signed_by_business' => $this->signed_by_business,
        ':image' => $this->image
      );
    }

    $query = $this->db->prepare($sql);
    $query->execute($parameters);
  }
}
