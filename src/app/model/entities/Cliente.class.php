<?php

require_once 'Pessoa.class.php';

/**
 * @Entity
 * @NamedQueries({
 *     @NamedQuery(name="Login", query="SELECT c FROM Cliente c WHERE c.email = :email and c.senha = :senha")
 * })
 * * */
class Cliente extends Pessoa {

    /**
     * @Column(type="string", unique=true)
     * * */
    private $email;

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

    function __construct() {
        $this->telefones = new Doctrine\Common\Collections\ArrayCollection();
        $this->enderecos = new Doctrine\Common\Collections\ArrayCollection();
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

}
