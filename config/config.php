<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

// Load configuration from the .env file
$dotEnv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotEnv->load();

$aggregator = new ConfigAggregator(
    [
        App\ConfigProvider::class,
        DoctrineOrm\ConfigProvider::class,
    ],
);

return $aggregator->getMergedConfig();
