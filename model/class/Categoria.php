<?php

class Categoria {
    private $id_categoria;
    private $nome;
    private $descricao;
    private $assunto;
    
    public function __construct($id_categoria, $nome, $descricao, Assunto $assunto) {
        $this->id_categoria = $id_categoria;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->assunto = $assunto;
    }
    
    public function getId_categoria() {
        return $this->id_categoria;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getAssunto() {
        return $this->assunto;
    }

}
