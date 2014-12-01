<?php

require_once 'C:\wamp\www\Restaurantes\vendor\autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Dao {

    private $em;

    public function __construct() {
        //$paths = array("../entities");
        $isDevMode = true;

        // the connection configuration
        $dbParams = array(
            'dbname' => 'restaurantes',
            'user' => 'root',
            'password' => '',
            'host' => '127.0.0.1',
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

    public function refreshEntity($entity) {
        $this->em->merge($entity);
        $this->em->flush();
    }

    public function findAll($entity) {
        $query = $this->em->createQuery("SELECT e FROM " . $entity . " e");
        return $query->getResult();
    }

    public function getListResultOfNamedQueryWithParameters($queryInstruction, $params) {
        $query = $this->em->createQuery($queryInstruction);

        foreach ($params as $key => $value) {
            $query->setParameter($key, $value);
        }
//        print_r($query->getParameters());
        return $query->getResult();
    }

    public function getSingleResultOfNamedQueryWithParameters($queryInstruction, $params) {
        $query = $this->em->createQuery($queryInstruction);
        $query->setParameters($params);
        return $query->getSingleResult();
    }

    public function getListResultOfNamedQuery($queryInstruction) {
        $query = $this->em->createQuery($queryInstruction);
        return $query->getResult();
    }

    public function executeQueryWithParameters($queryInstruction, $params) {
        $query = $this->em->createQuery($queryInstruction);
        $query->setParameters($params);
        $query->execute();
    }

    public function getListResultOfNativeQueryWithParameters($queryInstruction, $params) {
        $stmt = $this->em->getConnection()->prepare($queryInstruction);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getArrayResultOfNativeQueryWithParameters($queryInstruction, $params) {
        $stmt = $this->em->getConnection()->prepare($queryInstruction);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    
}
