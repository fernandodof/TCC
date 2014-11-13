<?php
class TamanhoVO {
    
    private $id;
    private $descricao;
    private $preco;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function getPreco() {
        setlocale(LC_ALL, ''); // Locale will be different on each system.
        $locale = localeconv();
        return $locale['currency_symbol'].number_format($this->preco, 2, $locale['decimal_point'], $locale['thousands_sep']);

    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

}
