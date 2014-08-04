<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once './vendor/autoload.php';

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);

//$conn = array(
//    'dbname' => 'restaurantes',
//    'user' => 'root',
//    'password' => '',
//    'host' => 'localhost',
//    'driver' => 'pdo_mysql',
//);

//$conn = array(
//    'dbname' => '1708725_rest',
//    'user' => '1708725_rest',
//    'password' => '#qaz@ijk6l',
//    'host' => '83.125.22.216',
//    'driver' => 'pdo_mysql',
//    'port' => '3306',
//);

$conn = array(
    'dbname' => 'sql348574',
    'user' => 'sql348574',
    'password' => 'cM9!rP1*',
    'host' => 'sql3.freesqldatabase.com',
    'driver' => 'pdo_mysql',
    'port' => '3306',
);

$entityManager = EntityManager::create($conn, $config);

$metadata = $entityManager->getMetadataFactory()->getAllMetadata();

if (!empty($metadata)) {
    $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
    $schemaTool->updateSchema($metadata);
}