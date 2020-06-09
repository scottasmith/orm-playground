<?php

declare(strict_types=1);

namespace DoctrineOrm;

use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class DependencyFactoryFactory
{
    public function __invoke(ContainerInterface $container): DependencyFactory
    {
        /** @var array $doctrineConfig */
        $doctrineConfig = $container->get('config')['doctrine'];

        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);

        return DependencyFactory::fromConnection(
            new ConfigurationArray($doctrineConfig['doctrine_migrations']),
            new ExistingConnection($em->getConnection())
        );
    }
}
