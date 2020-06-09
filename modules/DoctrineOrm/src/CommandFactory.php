<?php

declare(strict_types=1);

namespace DoctrineOrm;

use Doctrine\Migrations\DependencyFactory;
use Psr\Container\ContainerInterface;

class CommandFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName($container->get(DependencyFactory::class));
    }
}
