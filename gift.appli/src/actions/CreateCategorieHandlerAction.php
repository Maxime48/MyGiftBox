<?php

namespace gift\app\actions;

use gift\app\services\CategoriesService;
use Psr\Http\Message\ResponseInterface as Response;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;

class CreateCategorieHandlerAction extends Action
{

    /**
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {

        if(!isset($request->getParsedBody()['libelle'])){
            throw new \Exception("Le nom de la catégorie n'est pas renseigné");
        }

        if(!isset($request->getParsedBody()['description'])){
            throw new \Exception("La description de la catégorie n'est pas renseignée");
        }

        if(!isset($request->getParsedBody()['csrf_token'])){
            throw new \Exception("Le token CSRF n'est pas renseigné");
        }

        CsrfService::checkToken($request->getParsedBody()['csrf_token']);

        CategoriesService::createCategorie([
            'libelle' => $request->getParsedBody()['libelle'],
            'description' => $request->getParsedBody()['description']
        ]);

        return $response->withStatus(302)->withHeader(
            'Location', RouteContext::fromRequest($request)
                                ->getRouteParser()
                                ->urlFor('categories')
        );

    }
}

