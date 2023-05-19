<?php

namespace gift\app\actions;

use gift\app\services\prestation\PrestationNotFoundException;
use gift\app\services\prestation\PrestationsService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PrestationAction extends Action
{

    public function run(Request $request, Response $response, $args): string
    {
        if(!isset($request->getQueryParams()['id']) || empty($request->getQueryParams()['id'])){
            throw new \Slim\Exception\HttpBadRequestException($request, "Il faut passer un paramètre id dans la query-string de l'URL");
        }
        try {
            $prestation = (new PrestationsService)->getPrestationById($request->getQueryParams()['id']);
            $html = <<<HTML
                <html lang="fr">
                <head>
                    <title>Prestation {$prestation["libelle"]}</title>
                </head>
                <body>
                    <h1>Prestation: {$prestation["libelle"]}</h1>
                    <p>{$prestation["description"]}</p>
                </body>
                </html>
            HTML;
            return $html;
        } catch (PrestationNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($request, $e->getMessage());
        }
    }
}