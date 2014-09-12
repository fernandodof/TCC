<?php

/**
 * Description of Comentario
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Comentario {

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
     * @Column(type="text")
     * * */
    private $texto;

    /**
     * @Column(type="boolean")
     * * */
    private $disponivel = true;

    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="comentarios")
     * @JoinColumn(name="cliente_id", referencedColumnName="id")
     * */
    private $cliente;

    /**
     * @ManyToOne(targetEntity="Restaurante", inversedBy="comentarios")
     * @JoinColumn(name="restaurante_id", referencedColumnName="id")
     * */
    private $restaurante;

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

    public function getCliente() {
        return $this->cliente;
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
