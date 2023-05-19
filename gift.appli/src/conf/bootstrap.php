<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = \Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

return $app;