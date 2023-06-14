<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;

class BoxCreationHandlerAction extends Action
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

        BoxService::createEmptyBox([
            'libelle' => $request->getParsedBody()['libelle'],
            'description' => $request->getParsedBody()['description'],
            'kdo' => $request->getParsedBody()['kdo'],
            'message_kdo' => $request->getParsedBody()['message_kdo']
        ]);

        return $response->withStatus(302)->withHeader(
            'Location', RouteContext::fromRequest($request)
            ->getRouteParser()
            ->urlFor('categories') // TODO: a modifier quand page disponible
        );
    }
}