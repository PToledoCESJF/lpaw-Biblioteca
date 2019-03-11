<?php

class Pessoa {
    private $id_pessoa;
    private $nome;
    private $grupo;
    
    public function __construct($id_pessoa, $nome, $grupo) {
        $this->id_pessoa = $id_pessoa;
        $this->nome = $nome;
        $this->grupo = $grupo;
    }

    public function getId_pessoa() {
        return $this->id_pessoa;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getGrupo() {
        return $this->grupo;
    }

}
