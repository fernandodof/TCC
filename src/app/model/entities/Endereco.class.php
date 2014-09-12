<?php

/**
 * @Entity
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="TipoEndereco", type="string")
 * @DiscriminatorMap({"endereco" = "Endereco", "enderecoRestaurante" = "EnderecoRestaurante"})
 * * */
class Endereco {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="string")
     * 
     * * */
    private $descricao;

    /**
     * @Column(type="string")
     * * */
    private $logradouro;

    /**
     * @Column(type="string")
     * * */
    private $numero;

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
     * @Column(type="string", nullable=true)
     * * */
    private $complemento;

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCep() {
        return $this->cep;
    }

    function getEstado() {
        return $this->estado;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

}