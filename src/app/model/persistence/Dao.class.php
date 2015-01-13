<?php

//
//require_once 'C:\wamp\www\Restaurantes\vendor\autoload.php';
//echo str_replace("\\", '/',  dirname(__DIR__).'/');
//require_once "localhost/Restaurantes/vendor/autoload.php";
require_once $_SERVER["DOCUMENT_ROOT"].'/Restaurantes/vendor/autoload.php';

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

    public function getListResultOfNamedQueryWithParametersAndLimit($queryInstruction, $params, $start, $amount = 10) {
        $query = $this->em->createQuery($queryInstruction)->setFirstResult($start)->setMaxResults($amount);

        foreach ($params as $key => $value) {
            $query->setParameter($key, $value);
        }
        return $query->getResult();
    }

    public function getListResultOfQueryBuilderWithParameters($qbArray, $params) {

        $query1 = new Doctrine\ORM\QueryBuilder($this->em);

        $select = $qbArray['select'];
        $query1->select($select);
        foreach ($qbArray['from'] as $key => $value) {
            $query1->from($key, $value);
        }

        $query1->where($qbArray['where']);

        foreach ($params as $key => $value) {
            $query1->setParameter($key, $value);
        }

        return $query1->getQuery()->getArrayResult();
    }

    public function getListResultOfQueryBuilderWithParametersAndLimit($qbArray, $params, $start = null, $amount = null, $extraOrderBy = null, $keyword = null) {
        $query = new Doctrine\ORM\QueryBuilder($this->em);

        $select = $qbArray['select'];
        $query->select($select);
        foreach ($qbArray['from'] as $key => $value) {
            $query->from($key, $value);
        }

        foreach ($params as $key => $value) {
            $query->setParameter($key, $value);
        }

        if (isset($qbArray['orderby'])) {
            foreach ($qbArray['orderby'] as $key => $value) {
                $query->addOrderBy($key, $value);
            }
        }

        if ($extraOrderBy != null) {
            foreach ($extraOrderBy as $key => $value) {
                $query->addOrderBy($key, $value);
            }
        }

        if ($keyword !== null) {
            $keyword = '%' . $keyword . '%';
            $selectArray = array_map('trim', explode(',', $qbArray['select']));

            $i = 0;
            foreach ($selectArray as $s) {
                $i++;

                if (!strpos($s, 'id')) {
                    $query->orWhere($s . ' LIKE ?' . $i);
                    $query->setParameter($i, $keyword);
                }
            }
        }

        $query->andWhere($qbArray['where']);

        if ($start !== null) {
            $query->setFirstResult($start);
        }

        if ($amount !== null) {
            $query->setMaxResults($amount);
        }

        return $query->getQuery()->getArrayResult();
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
    
    public function getArrayResultOfNativeQuery($queryInstruction) {
        $stmt = $this->em->getConnection()->prepare($queryInstruction);
        $stmt->execute();
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