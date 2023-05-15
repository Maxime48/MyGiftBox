<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BoxCreationHandlerAction extends Action
{

    public function run(Request $request, Response $response, $args): string
    {
        $libelle = $request->getParsedBody()['libelle'];
        $description = $request->getParsedBody()['description'];
        $html = <<<HTML
            <html lang="fr">
            <head>
                <title>Création d'une box</title>
            </head>
            <body>
                <h1>Création d'une box</h1>
                <p>Libellé: $libelle</p>
                <p>Description: $description</p>
            </body>
            </html>
        HTML;
        return $html;
    }
}