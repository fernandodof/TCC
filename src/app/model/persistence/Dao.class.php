<?php

require_once 'C:/wamp/www/Restaurantes/vendor/autoload.php';

//require './../entities';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Dao {

    private $em;

    public function __construct() {
        //$paths = array("../entities");
        $isDevMode = false;

        // the connection configuration
        $dbParams = array(
            'dbname' => 'restaurantes',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../"), $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);

        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();

        if (!empty($metadata)) {
            $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
            $schemaTool->updateSchema($metadata);
        }

        $this->em = $entityManager;
    }

    public function findByKey($entity, $id) {
        return $this->em->find($entity, $id);
    }

    public function save($entity) {
        $this->em->beginTransaction();
        $this->em->persist($entity);
        $this->em->flush();
        $this->em->commit();
    }

    public function update($entity) {
        $this->em->beginTransaction();
        $this->em->merge($entity);
        $this->em->flush();
        $this->em->commit();
    }

    public function delete($entity) {
        $this->em->beginTransaction();
        $this->em->remove($entity);
        $this->em->flush();
        $this->em->commit();
    }

    public function findAll($entity) {
        $query = $this->em->createQuery("SELECT e FROM " . $entity . " e");
        return $query->getResult();
    }

    public function getResultOfNamedQueryWithParameters() {
        
    }

//    public function getEntityManager() {
//        return $this->em;
//        
//        $this->em->cre
//    }

}