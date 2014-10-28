<?php

/**
 * Description of EnderecoRestaurante
 *
 * @author Fernando
 */
require_once 'Endereco.class.php';

class EnderecoRestaurante extends Endereco {

    public function getBairro() {
        return parent::getBairro();
    }

    public function getCep() {
        return parent::getCep();
    }

    public function getCidade() {
        return parent::getCidade();
    }

    public function getComplemento() {
        return parent::getComplemento();
    }

    public function getDescricao() {
        return parent::getDescricao();
    }

    public function getEstado() {
        return parent::getEstado();
    }

    public function getId() {
        return parent::getId();
    }

    public function getLogradouro() {
        return parent::getLogradouro();
    }

    public function getNumero() {
        return parent::getNumero();
    }

    public function setBairro($bairro) {
        parent::setBairro($bairro);
    }

    public function setCep($cep) {
        parent::setCep($cep);
    }

    public function setCidade($cidade) {
        parent::setCidade($cidade);
    }

    public function setComplemento($complemento) {
        parent::setComplemento($complemento);
    }

    public function setDescricao($descricao) {
        parent::setDescricao($descricao);
    }

    public function setEstado($estado) {
        parent::setEstado($estado);
    }

    public function setId($id) {
        parent::setId($id);
    }

    public function setLogradouro($logradouro) {
        parent::setLogradouro($logradouro);
    }

    public function setNumero($numero) {
        parent::setNumero($numero);
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    /**
     * @Column(type="string")
     * * */
    private $latitude;

    /**
     * @Column(type="string")
     * * */
    private $longitude;

}
