<?php

declare(strict_types=1);

namespace DoctrineOrm;

use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Migrations\Tools\Console\Command;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'doctrine' => require dirname(__DIR__) . '/config/doctrine.php',
            'commands' => [
                Command\DumpSchemaCommand::class,
                Command\ExecuteCommand::class,
                Command\GenerateCommand::class,
                Command\LatestCommand::class,
                Command\ListCommand::class,
                Command\MigrateCommand::class,
                Command\RollupCommand::class,
                Command\StatusCommand::class,
                Command\SyncMetadataCommand::class,
                Command\VersionCommand::class,
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
                EntityManagerInterface::class => EntityManagerFactory::class,
                DependencyFactory::class => DependencyFactoryFactory::class,
                //
                Command\DumpSchemaCommand::class => CommandFactory::class,
                Command\ExecuteCommand::class => CommandFactory::class,
                Command\GenerateCommand::class => CommandFactory::class,
                Command\LatestCommand::class => CommandFactory::class,
                Command\ListCommand::class => CommandFactory::class,
                Command\MigrateCommand::class => CommandFactory::class,
                Command\RollupCommand::class => CommandFactory::class,
                Command\StatusCommand::class => CommandFactory::class,
                Command\SyncMetadataCommand::class => CommandFactory::class,
                Command\VersionCommand::class => CommandFactory::class,
            ],
        ];
    }
}
