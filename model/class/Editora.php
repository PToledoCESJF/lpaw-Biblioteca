<?php

class Editora {
    private $id_editora;
    private $nome_editora;
    
    function __construct($id_editora, $nome_editora) {
        $this->id_editora = $id_editora;
        $this->nome_editora = $nome_editora;
    }

    function getId_editora() {
        return $this->id_editora;
    }

    function getNome_editora() {
        return $this->nome_editora;
    }
}
