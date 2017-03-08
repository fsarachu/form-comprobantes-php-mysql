<?php


namespace App\Core;


use Joelvardy\Flash;
use Smarty;


abstract class Controller
{
  protected static function render($file_name, $data = [])
  {
    $smarty = new Smarty();
    $smarty->setEscapeHtml(true);
    $smarty->setTemplateDir(ROOT . 'resources/views');

    foreach ($data as $key => $value) {
      $smarty->assign($key, $value);
    }

    $smarty->assign('URL', $_SERVER['REQUEST_URI']);

    $flashes = Flash::message();
    $smarty->assign('flashes', $flashes);

    if (isset($flashes['error'])) {
      // If there was an error pass last input values
      $smarty->assign('form_defaults', [
        'currency' => $_SESSION['default_currency'],
        'payment_method' => $_SESSION['default_payment_method'],
        'amount' => $_SESSION['default_amount'],
        'description' => $_SESSION['default_description'],
        'signed_by_business' => $_SESSION['default_signed_by_business'] === 'true' ? true : false,
      ]);
    } else {
      // Always pass last selected currency
      $smarty->assign('form_defaults', [
        'currency' => $_SESSION['default_currency'],
        'payment_method' => null,
        'amount' => null,
        'description' => null,
        'signed_by_business' => null,
      ]);
    }

    $smarty->display($file_name);
  }

  protected static function redirect($url, $permanent = false)
  {
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
  }
}
