<?php

/**
 * Description of ItemPedido
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
require_once 'Tamanho.class.php';
require_once 'Categoria.class.php';
require_once 'Produto.class.php';

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
     * @ManyToOne(targetEntity="Produto", cascade="all")
     * @JoinColumn(name="id_produto", referencedColumnName="id")
     */
    private $produto;

    /**
     * @ManyToOne(targetEntity="Tamanho", cascade="all")
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
        setlocale(LC_ALL, ''); // Locale will be different on each system.
        $locale = localeconv();
        return $locale['currency_symbol'] . number_format($this->subtotal, 2, $locale['decimal_point'], $locale['thousands_sep']);
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

    public function setProduto(Produto $produto) {
        $this->produto = $produto;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho(Tamanho $tamanho) {
        $this->tamanho = $tamanho;
    }

}
