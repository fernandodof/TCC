<?php

/**
 * Description of Avaliacao
 *
 * @author Fernando
 */
require_once 'Cliente.class.php';
require_once 'Restaurante.class.php';

/**
 * @Entity
 * * */
class Avaliacao {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="datetime")
     * * */
    private $dataHora;

    /**
     * @Column(type="text", nullable=true)
     * * */
    private $texto;

    /**
     * @Column(type="boolean")
     * * */
    private $disponivel;

    /**
     * @Column(type="integer")
     * * */
    private $nota;

    public function getId() {
        return $this->id;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getDisponivel() {
        return $this->disponivel;
    }

    public function getNota() {
        return $this->nota;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }

    public function setNota($nota) {
        $this->nota = $nota;
    }
    

}
