<?php


namespace App\Core;


abstract class Controller
{
  protected function render($file_name, $data = [])
  {
    $smarty = new Smarty();
    $smarty->setTemplateDir(ROOT . 'resources/views');

    foreach ($data as $key => $value) {
      $smarty->assign($key, $value);
    }

    $smarty->display($file_name);
  }
}
