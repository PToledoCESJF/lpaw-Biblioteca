<?php

class Autores {
    private $id_autores;
    private $nome_autor;
    
    function __construct($id_autores, $nome_autor) {
        $this->id_autores = $id_autores;
        $this->nome = $nome;
    }
    
    function getId_autores() {
        return $this->id_autores;
    }

    function getNome_autor() {
        return $this->nome_autor;
    }

}
