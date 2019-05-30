<?php

class Autor {
    private $idAutor;
    private $nomeAutor;
    
    public function __construct($idAutor, $nomeAutor) {
        $this->idAutor = $idAutor;
        $this->nomeAutor = $nomeAutor;
    }
    
    public static function carregarVazio(){
        $this->idAutor = NULL;
        $this->nomeAutor = NULL;
        return new Autor($this->idAutor, $this->nomeAutor);
    }
    
    public function getIdAutor() {
        return $this->idAutor;
    }

    public function getNomeAutor() {
        return $this->nomeAutor;
    }

}
