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

$router->match('GET|POST', '/invoice/new', function () {
  InvoiceController::newInvoice();
});

$router->run();
