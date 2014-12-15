<?php

/**
 * Description of Produto
 *
 * @author Fernando
 */

/**
 * @Entity
 * * */
require_once 'Categoria.class.php';
require_once 'Tamanho.class.php';
require_once 'Comentario.class.php';

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
     * @Column(type="boolean")
     * * */
    private $disponivel = true;

    /**
     * @Column(type="string", nullable=true)
     * * */
    private $imagem;

    /**
     * @Column(type="text", nullable=true)
     * * */
    private $ingredientes;

    /**
     * @ManyToMany(targetEntity="Tamanho", cascade="all")
     * @JoinTable(name="Produto_Tamanho",
     *      joinColumns={@JoinColumn(name="id_produto", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_tamanho", referencedColumnName="id", unique=false)}
     *      )
     * */
    private $tamanhos;

    /**
     * @ManyToOne(targetEntity="Categoria")
     * @JoinColumn(name="id_categoria", referencedColumnName="id")
     */
    private $categoria;

    /**
     * @OneToMany(targetEntity="Comentario", mappedBy="produto", fetch="EXTRA_LAZY")
     * */
    private $comentarios;

    /**
     * @OneToMany(targetEntity="Avaliacao", mappedBy="produto", fetch="EXTRA_LAZY")
     * */
    private $avaliacoes;

    public function __construct() {
        $this->tamanhos = new Doctrine\Common\Collections\ArrayCollection();
        $this->comentarios = new Doctrine\Common\Collections\ArrayCollection();
        $this->avaliacoes = new Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
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

    public function addTamanho(Tamanho $tamaho) {
        $this->tamanhos->add($tamaho);
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
    public function getComentarios() {
        return $this->comentarios;
    }

    public function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    public function addComentario(Comentario $comentario){
        $this->avaliacoes->add($comentario);
    }
       
    public function getAvaliacoes() {
        return $this->avaliacoes;
    }

    public function setAvaliacoes($avaliacoes) {
        $this->avaliacoes = $avaliacoes;
    }

    public function addAvaliacao(Avaliacao $avaliacao){
        $this->avaliacoes->add($avaliacao);
    }
    
}
