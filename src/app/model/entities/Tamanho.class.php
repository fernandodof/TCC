<?php
/**
 * Description of Tamanho
 *
 * @author Fernando
 */

/**
 * @Entity
 * **/
class Tamanho {
    
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * **/
    private $id;
    /**
     * @Column(type="string")
     * **/
    private $descricao;
    /**
     * @Column(type="float")
     * **/
    private $preco;
    
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

    public function getPreco() {
        return $this->preco;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
    
    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
}
