<?php
// bootstrap.php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/vendor/autoload.php';

$symfonyCache = new ArrayAdapter();
$doctrineCache = DoctrineProvider::wrap($symfonyCache);

$paths = [__DIR__ . "/src/Entity"];
$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(
    $paths,
    $isDevMode,
    null,             // Directorio de caché (null lo desactiva)
    $doctrineCache,   // Instancia de caché convertida
    false             // No usar proxies automáticos
);

$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => 'mysql',
    'dbname'   => 'technologiesdb',
    'user'     => 'user',
    'password' => 'pass123',
    'charset'  => 'utf8'
];

$entityManager = EntityManager::create(DriverManager::getConnection($dbParams, $config), $config);
