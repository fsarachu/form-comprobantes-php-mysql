<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);

require ROOT . 'vendor/autoload.php';
require ROOT . 'config/config.php';

use App\Controllers\Error404;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use Bramus\Router\Router;

$router = new Router();

$router->set404(function () {
  header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
  Error404::index();
});

$router->get('/', function () {
  HomeController::index();
});

$router->get('/invoice/new', function () {
  InvoiceController::create();
});

$router->post('/invoice/new', function () {
  InvoiceController::store();
});

$router->get('/invoice/all', function () {
  InvoiceController::all();
});

$router->get('/validate', function () {
  $obj = new \App\Models\Invoice();

  echo '<h5>Before Set</h5>';
  echo '<pre>';
  print_r($obj);
  echo '</pre>';

  $obj->setInvoiceDate('2017-02-28');
  $obj->setPaymentMethod('2');
  $obj->setCurrency('4');
  $obj->setAmount('11.00');
  $obj->setDescription('ld,samdklasdklasm kdlasm dmaskl mdaskdlasm ldkasm dklsa');
  $obj->setSignedByBusiness('true');

  echo '<h5>After Set</h5>';
  echo '<pre>';
  print_r($obj);
  echo '</pre>';

  echo '<h5>Validate</h5>';
  echo '<pre>';
  print_r($obj->validate());
  echo '</pre>';

  echo '<h5>After Validate and Sanitize</h5>';
  echo '<pre>';
  print_r($obj);
  echo '</pre>';


});

$router->run();
