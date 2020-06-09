<?php
chdir(dirname(__DIR__));

require 'vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

(function ()
{
    /** @var ContainerInterface $container */
    $container = require dirname(__DIR__) . '/config/container.php';

    AppFactory::setContainer($container);

    $application = AppFactory::create();

    $routes = require dirname(__DIR__) . '/config/routes.php';
    $routes($application, $container);

    try {
        $application->run();
    } catch (Exception $exc) {
        echo "Unhandled Exception: " . $exc;
    }
})();
