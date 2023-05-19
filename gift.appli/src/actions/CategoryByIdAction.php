<?php

namespace gift\app\actions;

use gift\app\services\prestation\CategorieNotFoundException;
use gift\app\services\prestation\CategoriesService;
use gift\app\services\prestation\PrestationsService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;

class CategoryByIdAction extends Action
{

    public function run(Request $request, Response $response, $args): string
    {
        if (!isset($args['id']) || !is_numeric($args['id'])) {
            throw new HttpBadRequestException($request, "L'id de la catégorie doit être un nombre");
        }
        try {
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
        } catch (CategorieNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($request, $e->getMessage());
        }
    }
}