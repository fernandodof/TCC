<?php

/**
 * Description of ItemPedido
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class ItemPedido {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="integer")
     * * */
    private $quantidade;

    /**
     * @Column(type="float")
     * * */
    private $subtotal;

    /**
     * @ManyToOne(targetEntity="Produto")
     * @JoinColumn(name="id_produto", referencedColumnName="id")
     */
    private $produto;

    /**
     * @ManyToOne(targetEntity="Tamanho")
     * @JoinColumn(name="id_tamanho", referencedColumnName="id")
     */
    private $tamanho;

    public function getId() {
        return $this->id;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

}
