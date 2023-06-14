<?php

namespace gift\app\actions;

namespace gift\app\actions;
use gift\app\models\Categorie;
use gift\app\services\utils\CsrfService;
use \Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BoxCreationAction extends Action
{

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, Response $response, $args):Response
    {
        return Twig::fromRequest($request)->render($response, 'boxCreationForm.twig', [
            'csrf_token' => CsrfService::generateToken()
        ]);
    }
}