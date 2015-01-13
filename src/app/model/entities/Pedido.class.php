<?php

/**
 * Description of Pedido
 *
 * @author Fernando
 */
/**
 * @Entity
 * * */
require_once 'ItemPedido.class.php';

class Pedido {

    const PEDIDO_RECEBIDO = 1;
    const PEDIDO_COZINHA = 2;
    const PEDIDO_ENTREGA = 3;
    const PEDIDO_FINALIZADO = 4;

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

    /**
     * @ManyToOne(targetEntity="Cliente", inversedBy="pedidos")
     * @JoinColumn(name="id_cliente", referencedColumnName="id")
     * */
    private $cliente;

    /**
     * @ManyToOne(targetEntity="Restaurante", inversedBy="pedidos")
     * @JoinColumn(name="id_restaurante", referencedColumnName="id")
     * */
    private $restaurante;

    /**
     * @Column(type="integer")
     * * */
    private $status = 1;

    /**
     * @Column(type="string",nullable=true)
     * * */
    private $latitude = null;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $longitude = null;

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
        setlocale(LC_ALL, ''); // Locale will be different on each system.
        $locale = localeconv();
        return $locale['currency_symbol'] . number_format($this->valorTotal, 2, $locale['decimal_point'], $locale['thousands_sep']);
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

    public function getCliente() {
        return $this->cliente;
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

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

}
