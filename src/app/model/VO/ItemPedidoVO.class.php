<?php
class ItemPedidoVO {

    private $quantidade;
    private $subtotal;
    private $produto;
    private $tamanho;

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getSubtotal() {
        setlocale(LC_ALL, ''); // Locale will be different on each system.
        $locale = localeconv();
        return $locale['currency_symbol'] . number_format($this->subtotal, 2, $locale['decimal_point'], $locale['thousands_sep']);
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setProduto(ProdutoVO $produto) {
        $this->produto = $produto;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho(TamanhoVO $tamanho) {
        $this->tamanho = $tamanho;
    }

}
