<?php

namespace gift\app\actions;

use gift\app\services\CategoriesService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


class CategoriesAction extends Action
{

     public function __invoke(Request $request, Response $response, $args):Response
    {
        return Twig::fromRequest($request)->render($response, 'categories.twig',
            ['categories' => CategoriesService::getCategories()]
        );
    }
    
}