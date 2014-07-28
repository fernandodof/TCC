<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once './vendor/autoload.php';

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);

$conn = array(
    'dbname' => 'restaurantes',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$entityManager = EntityManager::create($conn, $config);

$metadata = $entityManager->getMetadataFactory()->getAllMetadata();

if (!empty($metadata)) {
    $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
    $schemaTool->updateSchema($metadata);
}