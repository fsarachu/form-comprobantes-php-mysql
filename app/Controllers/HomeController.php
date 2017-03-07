<?php


namespace App\Controllers;


use App\Core\Controller;


class HomeController extends Controller
{
  public static function index()
  {
    static::redirect(BASE_URL . 'invoice/add');
  }
}
