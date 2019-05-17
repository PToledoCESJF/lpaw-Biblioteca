<?php

class Categoria {
    private $idCategoria;
    private $nomeCategoria;
    private $assunto;
    
    public function __construct($idCategoria, $nomeCategoria, $assunto) {
        $this->idCategoria = $idCategoria;
        $this->nomeCategoria = $nomeCategoria;
        $this->assunto = $assunto;
    }
    
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    public function getAssunto() {
        return $this->assunto;
    }

}
