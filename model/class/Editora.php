<?php

class Editora {
    private $idEditora;
    private $nomeEditora;
    
    function __construct($idEditora, $nomeEditora) {
        $this->idEditora = $idEditora;
        $this->nomeEditora = $nomeEditora;
    }

    function getIdEditora() {
        return $this->idEditora;
    }

    function getNomeEditora() {
        return $this->nomeEditora;
    }
}
