<?php

/**
 * Description of Pedido
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Pedido {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="datetimne")
     * * */
    private $dataHora;

    /**
     * @ManyToMany(targetEntity="ItemPedido", cascade={"all"})
     * @JoinTable(name="Pedido_ItemPedido",
     *      joinColumns={@JoinColumn(name="id_pedido", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_itemPedido", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $itensPedido;

    /**
     * @Column(type="float")
     * * */
    private $valorTotal;

    /**
     * @Column(type="text", nullable=true)
     * * */
    private $observacoes;

    public function __construct() {
        $this->itensPedido = new Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function getItensPedido() {
        return $this->itensPedido;
    }

    public function getValorTotal() {
        return $this->valorTotal;
    }

    public function getObservacoes() {
        return $this->observacoes;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }

    public function setItensPedido($itensPedido) {
        $this->itensPedido = $itensPedido;
    }

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    public function setObservacoes($observacoes) {
        $this->observacoes = $observacoes;
    }

    public function addItemPedido(ItemPedido $itemPedido) {
        $this->itensPedido->add($itemPedido);
    }

}