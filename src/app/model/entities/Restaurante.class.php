<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Restaurante
 *
 * @author Fernando
 */
/**
 * @Entity
 * * */
require_once 'Endereco.class.php';
require_once 'TipoRestaurante.class.php';
require_once 'Produto.class.php';
require_once 'FormaPagamento.class.php';
require_once 'Pedido.class.php';
require_once 'Comentario.class.php';
require_once 'Avaliacao.class.php';

class Restaurante {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="string")
     * * */
    private $nome;

    /**
     * @Column(type="boolean")
     * * */
    private $aberto;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $logo = null;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $descricao = null;

    /**
     * @Column(type="boolean")
     * * */
    private $ativo = true;

    /**
     * @ManyToMany(targetEntity="Telefone", cascade={"all"})
     * @JoinTable(name="Restaurante_Telefone",
     *      joinColumns={@JoinColumn(name="id_restaurante", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_telefone", referencedColumnName="id")}
     *      )
     * */
    private $telefones;

    /**
     * @OneToOne(targetEntity="Endereco", mappedBy="Restaurante")
     * @JoinColumn(name="id_endereco", referencedColumnName="id")
     */
    private $endereco;

    /**
     * @ManyToOne(targetEntity="TipoRestaurante")
     * @JoinColumn(name="id_tipo", referencedColumnName="id")
     */
    private $tipo;

    /**
     * @ManyToMany(targetEntity="FormaPagamento", cascade={"all"})
     * @JoinTable(name="Restaurante_FormaPagamento",
     *      joinColumns={@JoinColumn(name="id_restaurante", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_formaPagamento", referencedColumnName="id", unique=false)}
     *      )
     * */
    private $formasPagamento;

    /**
     * @ManyToMany(targetEntity="Produto", cascade={"all"}, fetch="EXTRA_LAZY")
     * @JoinTable(name="Restaurante_Produto",
     *      joinColumns={@JoinColumn(name="id_restaurante", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_produto", referencedColumnName="id", unique=false)}
     *      )
     * @OrderBy({"nome" = "ASC"})
     * */
    private $produtos;

    /**
     * @OneToMany(targetEntity="Pedido", mappedBy="restaurante", fetch="EXTRA_LAZY")
     * */
    private $pedidos;

    /**
     * @OneToMany(targetEntity="Comentario", mappedBy="restaurante", fetch="EXTRA_LAZY")
     * */
    private $comentarios;

    /**
     * @OneToMany(targetEntity="Avaliacao", mappedBy="restaurante", fetch="EXTRA_LAZY")
     * */
    private $avaliacoes;

    public function __construct() {
        $this->comentarios = new Doctrine\Common\Collections\ArrayCollection();
        $this->avaliacoes = new Doctrine\Common\Collections\ArrayCollection();
        $this->formasPagamento = new Doctrine\Common\Collections\ArrayCollection();
        $this->produtos = new Doctrine\Common\Collections\ArrayCollection();
        $this->telefones = new Doctrine\Common\Collections\ArrayCollection();
        $this->pedidos = new Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAberto() {
        return $this->aberto;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getAvaliacoes() {
        return $this->avaliacoes;
    }

    public function getTelefones() {
        return $this->telefones;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getFormasPagamento() {
        return $this->formasPagamento;
    }

    public function getProdutos() {
        return $this->produtos;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setAberto($aberto) {
        $this->aberto = $aberto;
    }

    public function setLogo($logo) {
        $this->logo = $logo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setAvaliacoes($avaliacoes) {
        $this->avaliacoes = $avaliacoes;
    }

    public function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setFormasPagamento($formasPagamento) {
        $this->formasPagamento = $formasPagamento;
    }

    public function setProdutos($produtos) {
        $this->produtos = $produtos;
    }

    public function addProduto(Produto $produto) {
        $this->produtos->add($produto);
    }

    public function getPedidos() {
        return $this->pedidos;
    }

    public function setPedidos($pedidos) {
        $this->pedidos = $pedidos;
    }

    public function getComentarios() {
        return $this->comentarios;
    }

    public function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    public function addComentario(Comentario $comentario) {
        $this->comentarios->add($comentario);
    }

    public function addAvaliacao(Comentario $comentario) {
        $this->comentarios->add($comentario);
    }

    public function addPedido(Pedido $pedido) {
        $this->pedidos->add($pedido);
    }

}
