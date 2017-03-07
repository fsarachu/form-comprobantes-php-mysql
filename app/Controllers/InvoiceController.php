<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Currency;
use App\Models\PaymentMethod;

class InvoiceController extends Controller
{
  public static function create()
  {
    $data = [];

    $data['currencies'] = Currency::all();
    $data['default_currency'] = isset($_SESSION['default_currency']) ? $_SESSION['default_currency'] : 2;

    $data['payment_methods'] = PaymentMethod::all();
    $data['default_payment_method'] = isset($_SESSION['default_payment_method']) ? $_SESSION['default_payment_method'] : 1;

    static::render('form_invoice.tpl', $data);
  }

  public static function store()
  {
    $_SESSION['default_currency'] = $_POST['currency'];
    $_SESSION['default_payment_method'] = $_POST['payment_method'];
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
  }
}
