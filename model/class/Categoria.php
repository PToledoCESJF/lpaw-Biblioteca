<?php

class Categoria {
    private $idCategoria;
    private $nomeCategoria;
    private $descricao;
    private $assunto;
    
    public function __construct($idCategoria, $nomeCategoria, $descricao, $assunto) {
        $this->idCategoria = $idCategoria;
        $this->nomeCategoria = $nomeCategoria;
        $this->descricao = $descricao;
        $this->assunto = $assunto;
    }
    
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getAssunto() {
        return $this->assunto;
    }

}
