<?php
session_start();// lo uso para simular la base de datos
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
//use Slim\App\controllers\UserController;
require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();
require __DIR__ .'/../src/routes/rutasLogin.php';
require __DIR__ . '/../src/controllers/LoginController.php';
require __DIR__ . '/../src/routes/rutasUsuarios.php';
require __DIR__ . '/../src/controllers/UserController.php';
require __DIR__ . '/../src/routes/rutasProductos.php';
require __DIR__ . '/../src/controllers/ProductController.php';





$app->run();
