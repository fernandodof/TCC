<?php

require_once 'C:\wamp\www\Restaurantes\vendor\autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

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

        $conn = \Doctrine\DBAL\DriverManager::getConnection($dbParams);

        $schema = new \Doctrine\DBAL\Schema\Schema();
        $tabelaRecuperaSenha = $schema->createTable("recupera_senha");
        $tabelaRecuperaSenha->addColumn("id", "integer", array("unsigned" => true));
        $tabelaRecuperaSenha->addColumn("id_pessoa", "integer");
        $tabelaRecuperaSenha->addColumn("codigo", "float");
        $tabelaRecuperaSenha->addColumn("usado", "boolean");
        $tabelaRecuperaSenha->addColumn("expira", "datetime");
        $tabelaRecuperaSenha->setPrimaryKey(array("id"));

        $platform = $conn->getDatabasePlatform();

        $queries = $schema->toSql($platform);
       
        var_dump($queries);
        

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
        return $query->getResult();
    }

    public function getSingleResultOfNamedQueryWithParameters($queryInstruction, $params) {
        try {
            $query = $this->em->createQuery($queryInstruction);
            $query->setParameters($params);
            return $query->getSingleResult();
        } catch (NoResultException $ex) {
            return null;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function getListResultOfNamedQuery($queryInstruction) {
        $query = $this->em->createQuery($queryInstruction);
        return $query->getResult();
    }

    public function executeQueryWithParameters($queryInstruction, $params) {
        $this->em->beginTransaction();

        $query = $this->em->createQuery($queryInstruction);
        $query->setParameters($params);
        $query->execute();

        $this->em->flush();
        $this->em->commit();
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

    public function getListAssocResultOfNativeQueryWithParameters($queryInstruction, $params) {
        $stmt = $this->em->getConnection()->prepare($queryInstruction);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListAssocResultOfNativeQuery($queryInstruction) {
        $stmt = $this->em->getConnection()->prepare($queryInstruction);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
