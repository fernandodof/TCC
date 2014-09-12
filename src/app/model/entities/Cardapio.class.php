<?php

/**
 * Description of Cardapio
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Cardapio {

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     * * */
    private $id;

    /**
     * @Column(type="string")
     * * */
    private $nome;

    /**
     * @Column(type="boolean")
     * * */
    private $ativo = true;

    /**
     * @ManyToMany(targetEntity="Produto", cascade={"all"})
     * @JoinTable(name="Restaurante_Cardapio",
     *      joinColumns={@JoinColumn(name="id_cardapio", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_produto", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $produtos;

    public function __construct() {
        $this->produtos= new Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function getProdutos() {
        return $this->produtos;
    }

    public function setProdutos($produtos) {
        $this->produtos = $produtos;
    }

    public function addProdutos(Produto $produto){
        $this->produtos->add($produto);
    }
    
}
