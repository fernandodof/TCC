<?php

/**
 * Description of RecuperarSenha
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class RecuperarSenha {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     * * */
    private $id;

    /**
     * @ManyToOne(targetEntity="Pessoa", fetch="EXTRA_LAZY")
     * * */
    private $pessoa;

    /**
     * @Column(type="string", unique=true)
     * * */
    private $codigo;

    /**
     * @Column(type="boolean")
     * * */
    private $usado = false;

    /**
     * @Column(type="datetime")
     * * */
    private $expira;

    public function getId() {
        return $this->id;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getUsado() {
        return $this->usado;
    }

    public function getExpira() {
        return $this->expira;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setUsado($usado) {
        $this->usado = $usado;
    }

    public function setExpira($expira) {
        $this->expira = $expira;
    }

}
