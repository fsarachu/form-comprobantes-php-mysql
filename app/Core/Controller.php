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

    $smarty->assign('flashes', Flash::message());

    $smarty->assign('URL', $_SERVER['REQUEST_URI']);

    $smarty->display($file_name);
  }

  protected static function redirect($url, $permanent = false)
  {
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
  }
}
