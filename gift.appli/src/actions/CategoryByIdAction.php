<?php

namespace gift\app\actions;

<<<<<<< HEAD
use Psr\Http\Message\ResponseInterface as Response;
use gift\app\models\Categorie;
use Slim\Views\Twig;

=======
use gift\app\models\Categorie;
use gift\app\services\CategoriesService;
use gift\app\services\PrestationsService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
>>>>>>> parent of a1c5989 (V4 du TD3 - Q3 Fonctionelle)

class CategoryByIdAction extends Action
{

    public function __invoke($request, Response $response, $args): Response
    {
<<<<<<< HEAD
        $idOfCategorie = $args['id'];
        $categorie = Categorie::with('prestations')->findOrFail($idOfCategorie);
        $view = Twig::fromRequest($request);
        
        return $view->render($response, 'categorie.twig', ['categorie' => $categorie]);
=======
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
>>>>>>> parent of a1c5989 (V4 du TD3 - Q3 Fonctionelle)
    }
}
