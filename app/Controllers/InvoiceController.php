<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Currency;

class InvoiceController extends Controller
{
  public static function newInvoice()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        $data = [];
        $data['currencies'] = Currency::all();
        $data['default_currency'] = isset($_SESSION['default_currency']) ? $_SESSION['default_currency'] : 2;
        static::render('form_invoice.tpl', $data);
        break;
      case 'POST':
        $_SESSION['default_currency'] = $_POST['currency'];
        echo 'POST!';
    }

  }
}
