<?php

/**
 * Description of Restaurantes
 *
 * @author Fernando
 */

/**
 * @Entity
 * **/
class Restaurantes {
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * **/
    private $id;
    /**
     * @Column(type="string")
     * **/
    private $nome;
    /**
     * @Column(type="boolean")
     * **/
    private $aberto;
    /**
     * @Column(type="string")
     * **/
    private $logo;
    /**
     * @Column(type="string")
     * **/
    private $descricao;
    /**
     * @Column(type="boolean")
     * **/
    private $ativo=true;
    
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


}
