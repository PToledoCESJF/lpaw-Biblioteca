<?php

class Autor {
    private $idAutor;
    private $nomeAutor;
    
    function __construct($idAutor, $nomeAutor) {
        $this->idAutor = $idAutor;
        $this->nomeAutor = $nomeAutor;
    }
    
    function getIdAutor() {
        return $this->idAutor;
    }

    function getNomeAutor() {
        return $this->nomeAutor;
    }

}
