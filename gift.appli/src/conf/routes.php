<?php

namespace gift\app\conf;

use gift\app\actions\BoxCreationAction;
use gift\app\actions\BoxCreationHandlerAction;
use gift\app\actions\CategoriesAction;
use gift\app\actions\CategoryByIdAction;
use gift\app\actions\PrestationAction;





return function ($app) {


    $app->get('/categories[/]', CategoriesAction::class);

    $app->get('/categories/{id}', CategoryByIdAction::class);

    $app->get('/prestation', PrestationAction::class);

    $app->get('/boxes/new', BoxCreationAction::class);

    $app->post('/boxes/new', BoxCreationHandlerAction::class);

};