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

}
