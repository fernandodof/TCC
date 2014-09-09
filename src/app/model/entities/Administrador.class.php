<?php

require_once 'Pessoa.class.php';

/**
 * @Entity
 * * */
class Administrador extends Pessoa {

    /**
     * @Column(type="string", unique=true)
     * * */
    private $login;

    /**
     * @Column(type="datetime")
     * 
     * * */
    private $ultimoAcesso;

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

    public function getLogin() {
        return $this->login;
    }

    public function getUltimoAcesso() {
        return $this->ultimoAcesso;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setUltimoAcesso($ultimoAcesso) {
        $this->ultimoAcesso = $ultimoAcesso;
    }

}
