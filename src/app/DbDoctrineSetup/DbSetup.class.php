<?php

require_once './vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DbSetup {

    public function getEntityManager() {
        $isDevMode = false;

        $conn = array(
            'dbname' => 'restaurantes1',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "\src"), $isDevMode);
        $entityManager = EntityManager::create($conn, $config);

        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();

        if (!empty($metadata)) {
            $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
            $schemaTool->updateSchema($metadata);
        }

        return $entityManager;
    }

}
