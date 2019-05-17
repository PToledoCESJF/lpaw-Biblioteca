<?php

class Usuario {
    private $idUsuario;
    private $nomeUsuario;
    private $grupo;
    private $email;
    private $senha;
    
    public function __construct($idUsuario, $nomeUsuario, $grupo, $email, $senha) {
        $this->idUsuario = $idUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->grupo = $grupo;
        $this->email = $email;
        $this->senha = $senha;
        
    }
    
    public function consultarAcervo($pesquisa){
        
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
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
