<?php

/**
 * Description of Produto
 *
 * @author Fernando
 */
class ProdutoVO {

    private $id;
    private $nome;
    private $ingredientes;
    private $categoria;
    private $imagem;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIngredientes() {
        return $this->ingredientes;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setIngredientes($ingredientes) {
        $this->ingredientes = $ingredientes;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

}
