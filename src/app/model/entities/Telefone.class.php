<?php

/**
 * Description of Telefone
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Telefone {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * * */
    private $id;
    /**
     * @Column(type="string")
     * * */
    private $numero;

    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

}
