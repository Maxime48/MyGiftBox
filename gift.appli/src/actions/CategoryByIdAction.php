<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use gift\app\models\Categorie;
use Slim\Views\Twig;


class CategoryByIdAction extends Action
{

    public function __invoke($request, Response $response, $args): Response
    {
        $idOfCategorie = $args['id'];
        $categorie = Categorie::with('prestations')->findOrFail($idOfCategorie);
        $view = Twig::fromRequest($request);
        
        return $view->render($response, 'categorie.twig', ['categorie' => $categorie]);
    }
}
