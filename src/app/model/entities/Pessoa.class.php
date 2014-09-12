<?php
/**
 * Description of Pessoa
 *
 * @author Fernando
 */


/**
 * @MappedSuperclass
 * 
 * **/
class Pessoa {
    /**
     * @Column(type="integer")
     * @Id 
     * @GeneratedValue
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $nome;
    /**
     * @Column(type="string")
     * **/
    private $senha;
    /**
     * @Column(type="boolean")
     * */
    private $status;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
 
}
