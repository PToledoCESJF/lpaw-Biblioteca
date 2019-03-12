<?php

class Usuario {
    private $id_usuario;
    private $nome;
    private $grupo;
    private $email;
    private $senha;
    
    public function __construct($id_usuario, $nome, $grupo, $email, $senha) {
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->grupo = $grupo;
        $this->email = $email;
        $this->senha = $senha;
        
    }

    public function getId_usuario() {
        return $this->id_usuario;
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
