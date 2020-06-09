<?php

declare(strict_types=1);

namespace App;

use App\Console\ApplicationFactory;
use App\Console\Commands\CreateUserCommand;
use App\Console\Commands\GetUserCommand;
use App\Factories\UserManagerAwareFactory;
use App\Http\Handlers\GetUserHandler;
use App\Services\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'doctrine' => require dirname(__DIR__) . '/config/doctrine.php',
            'commands' => [
                CreateUserCommand::class,
                GetUserCommand::class,
            ],
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                // Console
                Application::class => ApplicationFactory::class,
                CreateUserCommand::class => UserManagerAwareFactory::class,
                GetUserCommand::class => UserManagerAwareFactory::class,

                // Http
                GetUserHandler::class => UserManagerAwareFactory::class,

                // Services
                UserManager::class => function (ContainerInterface $container) {
                    return new UserManager($container->get(EntityManagerInterface::class));
                },
            ],
        ];
    }
}
