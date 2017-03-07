<?php

namespace App\Controllers;

use App\Core\Controller;

class InvoiceController extends Controller
{
  public static function newInvoice()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        static::render('form_invoice.tpl');
        break;
      case 'POST':
        echo 'POST!';
    }

  }
}
