<?php

/**
 * Description of Cliente
 *
 * @author Fernando
 */
require_once 'Pessoa.class.php';
require_once 'Telefone.class.php';
require_once 'Comentario.class.php';
require_once 'Avaliacao.class.php';
require_once 'Endereco.class.php';
require_once 'Pedido.class.php';

/**
 * @Entity
 * * */
class Cliente extends Pessoa {

    /**
     * @Column(type="string", unique=true)
     * * */
    private $email;

    /**
     * @Column(type="float")
     * * */
    private $raioPref = 0.5;

    /**
     * @ManyToMany(targetEntity="Telefone", cascade={"all"})
     * @JoinTable(name="Pessoa_Telefone",
     *      joinColumns={@JoinColumn(name="id_pessoa", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_telefone", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $telefones;

    /**
     * @ManyToMany(targetEntity="Endereco", cascade={"all"})
     * @JoinTable(name="Pessoa_Endereco",
     *      joinColumns={@JoinColumn(name="id_pessoa", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_endereco", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $enderecos;

    /**
     * @OneToMany(targetEntity="Comentario", mappedBy="cliente", fetch="EXTRA_LAZY")
     * */
    private $comentarios;

    /**
     * @OneToMany(targetEntity="Avaliacao", mappedBy="cliente", fetch="EXTRA_LAZY")
     * */
    private $avaliacoes;

    /**
     * @OneToMany(targetEntity="Pedido", mappedBy="cliente", cascade={"all"}, fetch="EXTRA_LAZY")
     * @OrderBy({"dataHora" = "DESC"})
     * */
    private $pedidos;

    function __construct() {
        $this->telefones = new Doctrine\Common\Collections\ArrayCollection();
        $this->enderecos = new Doctrine\Common\Collections\ArrayCollection();
        $this->comentarios = new Doctrine\Common\Collections\ArrayCollection();
        $this->avaliacoes = new Doctrine\Common\Collections\ArrayCollection();
        $this->pedidos = new Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return parent::getId();
    }

    public function getNome() {
        return parent::getNome();
    }

    public function getSenha() {
        return parent::getSenha();
    }

    public function getStatus() {
        return parent::getStatus();
    }

    public function setId($id) {
        parent::setId($id);
    }

    public function setNome($nome) {
        parent::setNome($nome);
    }

    public function setSenha($senha) {
        parent::setSenha($senha);
    }

    public function setStatus($status) {
        parent::setStatus($status);
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelefones() {
        return $this->telefones;
    }

    public function setTelefones($telefones) {
        $this->telefones = $telefones;
    }

    public function addTelefone(Telefone $telefone) {
        $this->telefones->add($telefone);
    }

    public function getEnderecos() {
        return $this->enderecos;
    }

    public function setEnderecos($enderecos) {
        $this->enderecos = $enderecos;
    }

    public function addEndereco(Endereco $endereco) {
        $this->enderecos->add($endereco);
    }

    public function getComentarios() {
        return $this->comentarios;
    }

    public function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    public function getPedidos() {
        return $this->pedidos;
    }

    public function setPedidos($pedidos) {
        $this->pedidos = $pedidos;
    }

    public function getAvaliacoes() {
        return $this->avaliacoes;
    }

    public function setAvaliacoes($avaliacoes) {
        $this->avaliacoes = $avaliacoes;
    }

    public function addPedido(Pedido $pedido) {
        $this->pedidos->add($pedido);
    }

    public function addComentario(Comentario $comentario) {
        $this->comentarios->add($comentario);
    }

    public function addAvaliacao(Avaliacao $comentario) {
        $this->comentarios->add($comentario);
    }

    public function getLogin() {
        return parent::getLogin();
    }

    public function setLogin($login) {
        parent::setLogin($login);
    }

    public function getRaioPref() {
        return $this->raioPref;
    }

    public function setRaioPref($raioPref) {
        $this->raioPref = $raioPref;
    }
}
