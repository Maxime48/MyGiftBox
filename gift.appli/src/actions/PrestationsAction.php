<?php

namespace gift\app\actions;

use gift\app\services\PrestationsService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PrestationsAction extends Action
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if(!isset($request->getQueryParams()['id'])){
            throw new \Exception("L'id de la categorie n'est pas renseigné");
        }

        return Twig::fromRequest($request)->render($response, 'prestations.twig',
            ['prestations' => PrestationsService::getPrestationsByCategorie(
                    $request->getQueryParams()['id']
            )]
        );
    }
}