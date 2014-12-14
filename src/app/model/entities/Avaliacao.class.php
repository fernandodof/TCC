<?php

/**
 * Description of Avaliacao
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Avaliacao {

    /**
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     * @Id
     * * */
    private $id;

    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="avaliacoes")
     * @JoinColumn(name="id_cliente", referencedColumnName="id")
     * */
    private $cliente;

    /**
     * @ManyToOne(targetEntity="Restaurante", inversedBy="avaliacoes")
     * @JoinColumn(name="id_restaurante", referencedColumnName="id")
     * */
    private $restaurante = null;

    /**
     * @ManyToOne(targetEntity="Produto", inversedBy="avaliacoes")
     * @JoinColumn(name="id_produto", referencedColumnName="id")
     * */
    private $produto = null;

    /**
     * @Column(type="float")
     * * */
    private $nota;

    public function getId() {
        return $this->id;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getRestaurante() {
        return $this->restaurante;
    }

    public function getNota() {
        return $this->nota;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setRestaurante($restaurante) {
        $this->restaurante = $restaurante;
    }

    public function setNota($nota) {
        $this->nota = $nota;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

}
