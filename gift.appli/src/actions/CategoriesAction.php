<?php

namespace gift\app\actions;

<<<<<<< HEAD
use gift\app\prestation\CategoriesService;
=======
use gift\app\services\CategoriesService;
>>>>>>> parent of a1c5989 (V4 du TD3 - Q3 Fonctionelle)
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