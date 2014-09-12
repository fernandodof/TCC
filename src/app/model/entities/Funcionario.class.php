<?php
/**
 * Description of Funcionario
 *
 * @author Fernando
 */

require_once 'Pessoa.class.php';

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

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

}
