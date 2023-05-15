<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BoxCreationAction extends Action
{

    public function run(Request $request, Response $response, $args): string
    {
        $html = <<<HTML
            <html lang="fr">
            <head>
                <title>Création d'une box</title>
            </head>
            <body>
                <h1>Création d'une box</h1>
                <form method="post">
                    <label for="libelle">Libellé</label>
                    <input type="text" name="libelle" id="libelle" />
                    <br>
                    <label for="description">Description</label>
                    <textarea name="description" id="description"></textarea>
                    <br>
                    <input type="submit" value="Créer" />
                </form>
            </body>
            </html>
        HTML;
        return $html;
    }
}