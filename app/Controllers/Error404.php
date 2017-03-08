<?php


namespace App\Controllers;


use App\Core\Controller;

class Error404 extends Controller
{
  public static function index()
  {
    static::render('404.tpl');
  }
}
