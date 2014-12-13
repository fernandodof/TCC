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
     * @OneToOne(targetEntity="Restaurante", mappedBy="Funcionario")
     * @JoinColumn(name="id_restaurante", referencedColumnName="id")
     */
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

    public function getRestaurante() {
        return $this->restaurante;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function setRestaurante($restaurante) {
        $this->restaurante = $restaurante;
    }

    public function getLogin() {
        return parent::getLogin();
    }

    public function setLogin($login) {
        parent::setLogin($login);
    }

}
