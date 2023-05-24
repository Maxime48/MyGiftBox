<?php

use gift\app\services\utils\Eloquent;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

$app = \Slim\Factory\AppFactory::create();
<<<<<<< HEAD
=======
$app->addRoutingMiddleware();
>>>>>>> parent of a1c5989 (V4 du TD3 - Q3 Fonctionelle)

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true,false,false);
$app->setBasePath('/MyGiftBox/gift.appli/public');

Eloquent::init(__DIR__.'/conf.ini');

$twig = Twig::create(__DIR__.'/../template/');
$app->add(TwigMiddleware::create($app, $twig)) ;
$twig->getEnvironment()->addGlobal('basePath', $app->getBasePath());

return $app;
