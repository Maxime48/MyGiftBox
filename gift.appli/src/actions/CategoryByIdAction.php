<?php

namespace gift\app\actions;

use gift\app\models\Categorie;
use gift\app\services\CategoriesService;
use gift\app\services\PrestationsService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoryByIdAction extends Action
{

    public function run(Request $request, Response $response, $args): string
    {
        $categorie = (new CategoriesService)->getCategorieById($args['id']);
        $html = <<<HTML
            <html lang="fr">
            <head>
                <title>Catégorie {$categorie["libelle"]}</title>
            </head>
            <body>
                <h1>Catégorie {$categorie["libelle"]}</h1>
                <ul>
        HTML;
        foreach (
            (new PrestationsService())->getPrestationsByCategorie($categorie["id"]) as $prestation
        ) {
            $html .= <<<HTML
                    <li><a href="/prestation?id={$prestation["id"]}">{$prestation["libelle"]}</a></li>
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