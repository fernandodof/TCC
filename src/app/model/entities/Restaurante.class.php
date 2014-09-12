<?php

/**
 * Description of Restaurantes
 *
 * @author Fernando
 */
require_once 'Telefone.class.php';
require_once 'Cliente.class.php';
require_once 'Avaliacao.class.php';
require_once 'FormaPagamento.class.php';

/**
 * @Entity
 * * */
class Restaurantes {

    /**
     * @Column(type="integer")
     * @Id
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
     * @Column(type="string", nullable="true")
     * * */
    private $logo;

    /**
     * @Column(type="string")
     * * */
    private $descricao;

    /**
     * @Column(type="boolean")
     * * */
    private $ativo = true;

    /**
     * @ManyToMany(targetEntity="Telefone", cascade={"all"})
     * @JoinTable(name="Restaurante_Telefone",
     *      joinColumns={@JoinColumn(name="id_restaurante", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_telefone", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $telefones;

    /**
     * @OneToOne(targetEntity="EnderecoRestaurante")
     * @JoinColumn(name="id_endereco", referencedColumnName="id")
     * */
    private $endereco;

    /**
     * @OneToMany(targetEntity="Avaliacao", mappedBy="restaurante")
     * */
    private $avaliacoes;

    /**
     * @OneToOne(targetEntity="TipoRestaurante")
     * @JoinColumn(name="id_tipo", referencedColumnName="id")
     * */
    private $tipoRestaurante;

    /**
     * @ManyToMany(targetEntity="FormaPagamento", cascade={"all"})
     * @JoinTable(name="Restaurante_FormaPagamento",
     *      joinColumns={@JoinColumn(name="id_restaurante", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_formaPagamento", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $formasPagamento;

    /**
     * @OneToOne(targetEntity="Cardapio")
     * @JoinColumn(name="id_cardapio", referencedColumnName="id")
     * */
    private $cardapio;

    public function __construct() {
        $this->telefones = new Doctrine\Common\Collections\ArrayCollection();
        $this->avaliacoes = new Doctrine\Common\Collections\ArrayCollection();
        $this->formasPagamento = new Doctrine\Common\Collections\ArrayCollection();
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

    public function getTelefones() {
        return $this->telefones;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getAvaliacoes() {
        return $this->avaliacoes;
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

    public function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

    public function addTelefone(Telefone $telefone) {
        $this->telefones->add($telefone);
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setAvaliacoes($avaliacoes) {
        $this->avaliacoes = $avaliacoes;
    }

    public function addAvaliacao(Avaliacao $avaliacao) {
        $this->avaliacoes->add($avaliacao);
    }

    public function getTipoRestaurante() {
        return $this->tipoRestaurante;
    }

    public function setTipoRestaurante($tipoRestaurante) {
        $this->tipoRestaurante = $tipoRestaurante;
    }

    public function getFormasPagamento() {
        return $this->formasPagamento;
    }

    public function setFormasPagamento($formasPagamento) {
        $this->formasPagamento = $formasPagamento;
    }

    public function addFormaPagamento(FormaPagamento $formaPagamento) {
        $this->formasPagamento->add($formaPagamento);
    }

    public function getCardapio() {
        return $this->cardapio;
    }

    public function setCardapio($cardapio) {
        $this->cardapio = $cardapio;
    }

}
