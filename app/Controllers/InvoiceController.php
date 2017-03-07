<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Currency;
use App\Models\Invoice;
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

    $invoice = new Invoice();

    if (isset($_POST['invoice_date'])) {
      $invoice->setInvoiceDate($_POST['invoice_date']);
    }

    if (isset($_POST['payment_method'])) {
      $invoice->setPaymentMethod($_POST['payment_method']);
    }

    if (isset($_POST['currency'])) {
      $invoice->setCurrency($_POST['currency']);
    }

    if (isset($_POST['amount'])) {
      $invoice->setAmount($_POST['amount']);
    }

    if (isset($_POST['description'])) {
      $invoice->setDescription($_POST['description']);
    }

    if (isset($_POST['signed_by_business']) && $_POST['signed_by_business'] === 'true') {
      $invoice->setSignedByBusiness(true);
    }

    // TODO: Image upload

    try {
      $invoice->save();
      // TODO: Flash success message
      static::redirect(BASE_URL . 'invoice/all');
    } catch (Exception $e) {
      // TODO: Flash error message
      static::redirect(BASE_URL . 'invoice/new');
    }


  }
}
