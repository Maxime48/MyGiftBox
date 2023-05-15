<?php

namespace gift\app\conf;

use gift\app\actions\BoxCreationAction;
use gift\app\actions\BoxCreationHandlerAction;
use gift\app\actions\CategoriesAction;
use gift\app\actions\CategoryByIdAction;
use gift\app\actions\PrestationAction;
use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$db = new DB();
$db->addConnection(parse_ini_file(__DIR__ . '\..\conf\gift.db.conf.ini.dist'));
$db->setAsGlobal();
$db->bootEloquent();

return function ($app) {

    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });

    $app->get('/categories', CategoriesAction::class);

    $app->get('/categorie/{id}', CategoryByIdAction::class);

    $app->get('/prestation', PrestationAction::class);

    $app->get('/boxes/new', BoxCreationAction::class);

    $app->post('/boxes/new', BoxCreationHandlerAction::class);

};