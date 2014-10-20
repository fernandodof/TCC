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
     * @ManyToMany(targetEntity="Categoria", cascade={"all"})
     * @JoinTable(name="Tamanho_Categoria",
     *      joinColumns={@JoinColumn(name="id_tamanho", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_categoria", referencedColumnName="id", unique=false)}
     *      )
     * */
    private $categoria;


    public function __construct() {
        $this->categoria = new Doctrine\Common\Collections\ArrayCollection();
    }
    
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
