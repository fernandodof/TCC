<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("./src/app/model/entities");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'dbname' => 'restaurantes',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

$metadata = $entityManager->getMetadataFactory()->getAllMetadata();

if (!empty($metadata)) {
    $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
    $schemaTool->updateSchema($metadata);
}
