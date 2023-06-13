<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CreateCategorieAction extends Action
{

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        return Twig::fromRequest($request)->render($response, 'formCreationCategorie.twig', [
            'csrf_token' => CsrfService::generateToken()
        ]);
    }
}

// Path: gift.appli/src/actions/CreateCadeauAction.php&