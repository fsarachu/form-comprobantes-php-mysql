<?php


namespace App\Controllers;


use App\Core\Controller;


class Home extends Controller
{
  public static function index()
  {
    static::redirect(BASE_URL . 'invoice/add');
  }
}
