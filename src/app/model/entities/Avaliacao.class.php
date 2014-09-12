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
     * @Column(type="float")
     * * */
    private $nota;

    /**
     * @Column(type="datetime")
     * * */
    private $dataHora;

    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="avaliacoes")
     * @JoinColumn(name="id_cliente", referencedColumnName="id")
     * */
    private $cliente;

    /**
     * @ManyToOne(targetEntity="Restaurante", inversedBy="avaliacoes")
     * @JoinColumn(name="id_restaurante", referencedColumnName="id")
     * */
    private $restaurante;

    public function getId() {
        return $this->id;
    }

    public function getNota() {
        return $this->nota;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNota($nota) {
        $this->nota = $nota;
    }

    public function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function getRestaurante() {
        return $this->restaurante;
    }

    public function setRestaurante($restaurante) {
        $this->restaurante = $restaurante;
    }

}
