<?php

namespace gift\app\actions;

use gift\app\services\prestation\CategoriesService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesAction extends Action
{

    public function run(Request $request, Response $response, $args): string
    {
        $categories = (new CategoriesService)->getCategories();
        $html = <<<HTML
            <html lang="fr">
            <head>
                <title>Liste des catégories</title>
            </head>
            <body>
                <h1>Liste des catégories</h1>
                <ul>
        HTML;
        foreach ($categories as $categorie) {
            $html .= <<<HTML
                    <li><a href="/categorie/{$categorie["id"]}">{$categorie["libelle"]}</a></li>
            HTML;
        }
        $html .= <<<HTML
                </ul>
            </body>
            </html>
        HTML;
        return $html;
    }
}