<?php

class Pessoa {
    private $id_pessoa;
    private $nome;
    private $grupo;
    private $email;
    private $senha;
    
    public function __construct($id_pessoa, $nome, $grupo, $email, $senha) {
        $this->id_pessoa = $id_pessoa;
        $this->nome = $nome;
        $this->grupo = $grupo;
        $this->email = $email;
        $this->senha = $senha;
        
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
    
    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }
}
