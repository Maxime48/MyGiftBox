<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface as Response;


class AccueilAction extends Action
{
    public function __invoke( $request, Response $response, $args): Response
    {
        $response->getBody()->write('
            <html>
            <head>
                <title>Accueil</title>
            </head>
            <body>
                <h1>Bienvenue sur la page d\'accueil</h1>
            </body>
            </html>
        ');

        return $response;
    }
}
