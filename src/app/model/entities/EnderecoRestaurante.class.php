<?php
/**
 * Description of EnderecoRestaurante
 *
 * @author Fernando
 */


/**
 * @Entity
 * **/
class EnderecoRestaurante extends Endereco {

    /**
     * @Column(type="string")
     * * */
    private $latitude;
    /**
     * @Column(type="string")
     * * */
    private $longitude;
    
    public function getBairro() {
        return parent::getBairro();
    }

    public function getCep() {
        return parent::getCep();
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
    
    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

}
