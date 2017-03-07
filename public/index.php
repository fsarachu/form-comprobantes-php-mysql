<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);

require ROOT . 'vendor/autoload.php';
require ROOT . 'config/config.php';

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use Bramus\Router\Router;

$router = new Router();

$router->set404(function () {
  header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
  echo '404, route not found!';
});

$router->get('/', function () {
  HomeController::index();
});

$router->match('GET|POST', '/invoice/new', function () {
  InvoiceController::newInvoice();
});

$router->run();
