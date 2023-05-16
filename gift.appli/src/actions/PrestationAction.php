<?php

namespace gift\app\actions;

use gift\app\services\PrestationsService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PrestationAction extends Action
{

    public function run(Request $request, Response $response, $args): string
    {
        $id = $request->getQueryParams()['id'];
        if ($id == null) {
            $html = <<<HTML
            <html lang="fr">
            <head>
                <title>Erreur</title>
            </head>
            <body>
                <h1>Erreur</h1>
                <p>Il faut passer un paramètre id dans la query-string de l'URL</p>
            </body>
            </html>
        HTML;
        } else {
            $prestation = (new PrestationsService)->getPrestationById($id);
            if ($prestation == null) {
                $html = <<<HTML
                <html lang="fr">
                <head>
                    <title>Erreur</title>
                </head>
                <body>
                    <h1>Erreur</h1>
                    <p>Il n'y a pas de prestation avec l'id $id</p>
                </body>
                </html>
            HTML;
            } else {
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
            }
        }
        return $html;
    }
}