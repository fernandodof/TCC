<?php

/**
 * Description of Endereco
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Endereco {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="string", nullable=true)
     * 
     * * */
    private $descricao = null;

    /**
     * @Column(type="string")
     * * */
    private $logradouro;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $numero = 'Sem numero';

    /**
     * @Column(type="string")
     * * */
    private $bairro;

    /**
     * @Column(type="string")
     * * */
    private $cep;

    /**
     * @Column(type="string")
     * * */
    private $estado;

    /**
     * @Column(type="string")
     * * */
    private $cidade;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $complemento = null;

    /**
     * @Column(type="string",nullable=true)
     * * */
    private $latitude;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $longitude;

    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
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


    
}
