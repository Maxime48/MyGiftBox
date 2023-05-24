<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Action
{

<<<<<<< HEAD
    public abstract function __invoke($request, Response $response,$args):Response;
    
=======
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $html = $this->run($request, $response, $args);
        $response->getBody()->write($html);
        return $response;
    }

    abstract public function run(Request $request, Response $response, $args): string;

>>>>>>> parent of a1c5989 (V4 du TD3 - Q3 Fonctionelle)
}