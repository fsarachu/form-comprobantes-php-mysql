<?php


namespace App\Core;


use Smarty;


abstract class Controller
{
  protected static function render($file_name, $data = [])
  {
    $smarty = new Smarty();
    $smarty->setTemplateDir(ROOT . 'resources/views');

    foreach ($data as $key => $value) {
      $smarty->assign($key, $value);
    }

    $smarty->display($file_name);
  }

  protected static function redirect($url, $permanent = false)
  {
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
  }
}
