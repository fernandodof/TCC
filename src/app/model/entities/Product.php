<?php

/**
 * Description of Product
 *
 * @author Fernando
 */

/**
 * @Entity
 * */
class Product {

    /** @Id
     * @Column(type="integer") 
     * @GeneratedValue
     */
    protected $id = null;

    /** @Column(type="string") * */
    protected $name;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

}
