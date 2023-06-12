<?php

namespace gift\app\actions;

use gift\app\services\CategoriesService;
use Psr\Http\Message\ResponseInterface as Response;
use gift\app\models\Categorie;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CreateCatgorieAction extends Action
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $csrfToken = CsrfService::generateToken();

        return Twig::fromRequest($request)->render($response, 'create_categorie.twig', [
            'csrf_token' => $csrfToken
        ]);
    }
}

// Path: gift.appli/src/actions/CreateCadeauAction.php