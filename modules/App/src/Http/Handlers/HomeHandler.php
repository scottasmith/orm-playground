<?php

declare(strict_types=1);

namespace App\Http\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeHandler
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write('
            Find user:<br>
            <form action="/user" method="get">
                <input name="username">
                <button type="submit">Find</button>
            </form>
        ');
        return $response;
    }
}
