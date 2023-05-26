<?php

namespace gift\app\actions;

use gift\app\services\CategoriesService;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;


class CategoriesAction extends Action
{

     public function __invoke($request, Response $response,$args):Response
    {
        $categories = CategoriesService::getCategories();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories.twig', ['categories' => $categories]);

    }
    
}