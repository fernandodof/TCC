<?php

/**
 * Description of Produto
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Produto {

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
     * @Column(type="string")
     * * */
    private $tipo;

    /**
     * @Column(type="boolean")
     * * */
    private $disponivel = true;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $imagem;

    /**
     * @Column(type="text")
     * * */
    private $ingredientes;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getDisponivel() {
        return $this->disponivel;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getIngredientes() {
        return $this->ingredientes;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setIngredientes($ingredientes) {
        $this->ingredientes = $ingredientes;
    }

}
