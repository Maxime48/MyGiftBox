<?php

namespace gift\app\actions;

use gift\app\services\CategoriesService;
use Psr\Http\Message\ResponseInterface as Response;
use gift\app\models\Categorie;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CreateCatgorieAction extends Action
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $categorie = new Categorie();
        $categorie->nom = $request->getParsedBody()['nom'];
        $categorie->description = $request->getParsedBody()['description'];
        $categorie->save();
        return Twig::fromRequest($request)->render($response, 'categorie.twig',
            ['categorie' =>
                CategoriesService::getCategorieById($categorie->id)
            ]
        );
    }
}