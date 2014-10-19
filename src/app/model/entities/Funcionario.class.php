<?php

/**
 * Description of Funcionario
 *
 * @author Fernando
 */
require_once 'Pessoa.class.php';
require_once 'Restaurante.class.php';

/**
 * @Entity
 * * */
class Funcionario extends Pessoa {

    /**
     * @Column(type="string")
     * * */
    private $cargo;

    /**
     * @Column(type="string", unique=true)
     * * */
    private $login;

    /**
     * @ManyToMany(targetEntity="Restaurante", cascade={"all"})
     * @JoinTable(name="Funcionario_Restaurante",
     *      joinColumns={@JoinColumn(name="id_funcionario", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_restaurante", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $restaurante;

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

    public function getCargo() {
        return $this->cargo;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getRestaurante() {
        return $this->restaurante;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setRestaurante($restaurante) {
        $this->restaurante = $restaurante;
    }

}
