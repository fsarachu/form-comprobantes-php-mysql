<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use BulletProof\Image;
use Joelvardy\Flash;

class InvoiceController extends Controller
{
  public static function create()
  {
    $data = [];

    $data['currencies'] = Currency::all();
    $data['default_currency'] = isset($_SESSION['default_currency']) ? $_SESSION['default_currency'] : 2;

    $data['payment_methods'] = PaymentMethod::all();
    $data['default_payment_method'] = isset($_SESSION['default_payment_method']) ? $_SESSION['default_payment_method'] : 1;

    static::render('invoice_form.tpl', $data);
  }

  public static function store()
  {
    $invoice = new Invoice();

    if (isset($_POST['invoice_date'])) {
      $invoice->setInvoiceDate($_POST['invoice_date']);
    }

    if (isset($_POST['payment_method'])) {
      $invoice->setPaymentMethod($_POST['payment_method']);
      $_SESSION['default_payment_method'] = $_POST['payment_method'];
    }

    if (isset($_POST['currency'])) {
      $invoice->setCurrency($_POST['currency']);
      $_SESSION['default_currency'] = $_POST['currency'];
    }

    if (isset($_POST['amount'])) {
      $invoice->setAmount($_POST['amount']);
      $_SESSION['default_amount'] = $_POST['amount'];
    }

    if (isset($_POST['description'])) {
      $invoice->setDescription($_POST['description']);
      $_SESSION['default_description'] = $_POST['description'];
    }

    if (isset($_POST['signed_by_business']) && $_POST['signed_by_business'] === 'true') {
      $invoice->setSignedByBusiness(true);
      $_SESSION['default_signed_by_business'] = $_POST['signed_by_business'];
    }

    $image = new Image($_FILES);
    $image->setLocation(ROOT . UPLOAD_DIR, '0777');
    $image->setSize(1, 2 * 1024 * 1024);
    $image->setDimension(5000, 5000);

    if ($image["invoice_image"]) {
      $upload = $image->upload();

      if ($upload) {
        $image_url = UPLOAD_URL . $image->getName() . '.' . $image->getMime();
        $invoice->setImage($image_url);
      } else {
        Flash::message('error', 'No se  pudo subir la imagen');
        Flash::message('error', $image['error']);

        static::redirect(BASE_URL . 'invoice/new');
      }
    } else {
      Flash::message('warning', 'No se adjuntó imagen');
    }

    try {
      $invoice->save();
      Flash::message('success', 'Comprobante cargado con éxito!');
      static::redirect(BASE_URL . 'invoice/all');
    } catch (\Exception $e) {
      Flash::message('error', 'No se pudo cargar el comprobante: ' . $e->getMessage());
      static::redirect(BASE_URL . 'invoice/new');
    }
  }

  public static function all()
  {
    $data['invoices'] = Invoice::all();
    static::render('invoice_list.tpl', $data);
  }
}
