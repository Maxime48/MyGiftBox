<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Action
{

    public function __invoke(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write($this->run($request, $response, $args));
        return $response;
    }

    abstract public function run(Request $request, Response $response, $args): string;

}