<?php

/**
 * Description of Produto
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
class Produto {

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
     * @Column(type="string")
     * * */
    private $tipo;

    /**
     * @Column(type="boolean")
     * * */
    private $disponivel = true;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $imagem;

    /**
     * @Column(type="text")
     * * */
    private $ingredientes;

    /**
     * @ManyToMany(targetEntity="Tamanho", cascade={"all"})
     * @JoinTable(name="Produto_Tamanho",
     *      joinColumns={@JoinColumn(name="id_produto", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_tamanho", referencedColumnName="id", unique=true)}
     *      )
     * */
    private $tamanhos;

    public function __construct() {
        $this->tamanhos = new Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getDisponivel() {
        return $this->disponivel;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getIngredientes() {
        return $this->ingredientes;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setIngredientes($ingredientes) {
        $this->ingredientes = $ingredientes;
    }

    public function getTamanhos() {
        return $this->tamanhos;
    }

    public function setTamanhos($tamanhos) {
        $this->tamanhos = $tamanhos;
    }

    public function addTamanho(Tamanho $tamaho){
        $this->tamanhos->add($tamaho);
    }
}
