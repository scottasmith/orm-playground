<?php

use App\Http\Handlers\GetUserHandler;
use App\Http\Handlers\HomeHandler;
use Psr\Container\ContainerInterface;
use Slim\App;

/**
 * @param App $app
 * @param ContainerInterface $container
 */
return function (App $app, ContainerInterface $container): void {
    // Home
    $app->get('/', HomeHandler::class);

    // User
    $app->get('/user', GetUserHandler::class);
};
