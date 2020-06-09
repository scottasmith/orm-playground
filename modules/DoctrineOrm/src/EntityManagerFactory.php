<?php

declare(strict_types=1);

namespace DoctrineOrm;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    /**
     * @param ContainerInterface $container
     * @return EntityManagerInterface
     * @throws ORMException
     */
    public function __invoke(ContainerInterface $container): EntityManagerInterface
    {
        $doctrineConfig = $container->get('config')['doctrine'];

        $config = Setup::createAnnotationMetadataConfiguration(
            $doctrineConfig['paths'],
            getenv('DOCTRINE_DEV_MODE', false),
            null,
            null,
            false
        );

        return EntityManager::create([
           'driver'   => $doctrineConfig['connection']['driver'] ?? 'pdo_mysql',
           'dbname'   => $doctrineConfig['connection']['database'],
           'user'     => $doctrineConfig['connection']['username'],
           'password' => $doctrineConfig['connection']['password'],
           'host'     => $doctrineConfig['connection']['host'],
       ], $config);
    }
}
