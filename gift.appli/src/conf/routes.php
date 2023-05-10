<?php

use gift\app\models\Categorie;
use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$db = new DB();
$db->addConnection(parse_ini_file(__DIR__ . '\..\conf\gift.db.conf.ini.dist'));
$db->setAsGlobal();
$db->bootEloquent();

return function ($app) {

    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });

    $app->get('/categories', function (Request $request, Response $response, $args) {
        $categories = Categorie::all();
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
                    <li><a href="/categorie/{$categorie->id}">{$categorie->libelle}</a></li>
            HTML;
        }
        $html .= <<<HTML
                </ul>
            </body>
            </html>
        HTML;
        $response->getBody()->write($html);
        return $response;
    });

    $app->get('/categorie/{id}', function (Request $request, Response $response, $args) {
        $categorie = Categorie::find($args['id']);
        $html = <<<HTML
            <html lang="fr">
            <head>
                <title>Catégorie {$categorie->libelle}</title>
            </head>
            <body>
                <h1>Catégorie {$categorie->libelle}</h1>
                <ul>
        HTML;
        foreach ($categorie->prestations as $prestation) {
            $html .= <<<HTML
                    <li><a href="/prestation?id={$prestation->id}">{$prestation->libelle}</a></li>
            HTML;
        }
        $html .= <<<HTML
                </ul>
            </body>
            </html>
        HTML;
        $response->getBody()->write($html);
        return $response;
    });

    $app->get('/prestation', function (Request $request, Response $response, $args) {
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
            $prestation = \gift\app\models\Prestation::find($id);
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
                    <title>Prestation {$prestation->libelle}</title>
                </head>
                <body>
                    <h1>Prestation: {$prestation->libelle}</h1>
                    <p>{$prestation->description}</p>
                </body>
                </html>
            HTML;
            }
        }
        $response->getBody()->write($html);
        return $response;
    });

$app->get('/boxes/new', function (Request $request, Response $response, $args) {
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
        $response->getBody()->write($html);
        return $response;
    });

    $app->post('/boxes/new', function (Request $request, Response $response, $args) {
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
        $response->getBody()->write($html);
        return $response;
    });

};