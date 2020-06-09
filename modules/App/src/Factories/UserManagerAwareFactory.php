<?php

declare(strict_types=1);

namespace App\Factories;

use App\Services\UserManager;
use Psr\Container\ContainerInterface;

class UserManagerAwareFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return new $requestedName($container->get(UserManager::class));
    }
}
