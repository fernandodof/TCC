<?php

/**
 * Description of Comentario
 *
 * @author Fernando
 */
require_once 'Cliente.class.php';
require_once 'Restaurante.class.php';

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
     * @Column(type="text", nullable=true)
     * * */
    private $texto;

    /**
     * @Column(type="boolean")
     * * */
    private $disponivel;

    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="comentarios")
     * @JoinColumn(name="id_cliente", referencedColumnName="id")
     * */
    private $cliente;

    /**
     * @ManyToOne(targetEntity="Restaurante", inversedBy="comentarios")
     * @JoinColumn(name="id_restaurante", referencedColumnName="id")
     * */
    private $restaurante = null;

    /**
     * @ManyToOne(targetEntity="Produto", inversedBy="comentarios")
     * @JoinColumn(name="id_produto", referencedColumnName="id")
     * */
    private $produto = null;

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

    public function getCliente() {
        return $this->cliente;
    }

    public function getRestaurante() {
        return $this->restaurante;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setRestaurante($restaurante) {
        $this->restaurante = $restaurante;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

}
