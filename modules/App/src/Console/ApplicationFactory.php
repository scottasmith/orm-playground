<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\CreateUserCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

final class ApplicationFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $application = new Application();

        $config = $container->get('config');

        if (isset($config['commands'])) {
            foreach ($config['commands'] as $command) {
                $application->add($container->get($command));
            }
        }

        return $application;
    }
}
