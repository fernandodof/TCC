<?php
class PedidoVO {

    private $itensPedido;
    private $valorTotal;

    public function getItensPedido() {
        return $this->itensPedido;
    }

    public function getValorTotal() {
        setlocale(LC_ALL, ''); // Locale will be different on each system.
        $locale = localeconv();
        return $locale['currency_symbol'].number_format($this->valorTotal, 2, $locale['decimal_point'], $locale['thousands_sep']);
    }

    public function setItensPedido($itensPedido) {
        $this->itensPedido = $itensPedido;
    }

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    public function addItemPedido(ItemPedidoVO $itemPedido) {
        $this->itensPedido[] = $itemPedido;
    }

}
