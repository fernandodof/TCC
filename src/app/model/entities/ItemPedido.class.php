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

}
