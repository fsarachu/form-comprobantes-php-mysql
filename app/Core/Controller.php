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

    $smarty->assign('CURRENT_URL', $_SERVER['REQUEST_URI']);
    $smarty->assign('BASE_URL', BASE_URL);

    $flashes = Flash::message();
    $smarty->assign('flashes', $flashes);

    if (isset($flashes['error'])) {
      // If there was an error pass last input values
      $smarty->assign('form_defaults', [
        'currency' => isset($_SESSION['default_currency']) ? $_SESSION['default_currency'] : null,
        'payment_method' => isset($_SESSION['default_payment_method']) ? $_SESSION['default_payment_method'] : null,
        'amount' => isset($_SESSION['default_amount']) ? $_SESSION['default_amount'] : null,
        'description' => isset($_SESSION['default_description']) ? $_SESSION['default_description'] : null,
        'signed_by_business' => isset($_SESSION['default_signed_by_business']) && $_SESSION['default_signed_by_business'] === 'true' ? true : false,
      ]);
    } else {
      // Always pass last selected currency
      $smarty->assign('form_defaults', [
        'currency' => isset($_SESSION['default_currency']) ? $_SESSION['default_currency'] : null,
        'payment_method' => null,
        'amount' => null,
        'description' => null,
        'signed_by_business' => null,
      ]);
    }
    $smarty->assign('dirty', '<strong>DIRTY</strong>');
    $smarty->display($file_name);
  }

  protected static function redirect($url, $permanent = false)
  {
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
  }
}
