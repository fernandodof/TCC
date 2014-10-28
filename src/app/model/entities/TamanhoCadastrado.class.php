<?php

/**
 * Description of TamanhosCadastrados
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class TamanhoCadastrado {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="string")
     * * */
    private $descricao;

    /**
     * @ManyToOne(targetEntity="Categoria")
     * @JoinColumn(name="id_categoria", referencedColumnName="id")
     */
    private $categoria;

    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

}
