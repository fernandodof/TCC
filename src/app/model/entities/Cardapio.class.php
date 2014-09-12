<?php
/**
 * Description of Cardapio
 *
 * @author Fernando
 */

/**
 * @Entity
 * **/
class Cardapio {
    
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
    private $ativo = true;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
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

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

}
