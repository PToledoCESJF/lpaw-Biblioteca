<?php

class Categoria {
    private $id_categoria;
    private $nome_categoria;
    private $descricao;
    private $assunto;
    
    public function __construct($id_categoria, $nome_categoria, $descricao, Assunto $assunto) {
        $this->id_categoria = $id_categoria;
        $this->nome_categoria = $nome_categoria;
        $this->descricao = $descricao;
        $this->assunto = $assunto;
    }
    
    public function getId_categoria() {
        return $this->id_categoria;
    }

    public function getNome_categoria() {
        return $this->nome_categoria;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getAssunto() {
        return $this->assunto;
    }

}
