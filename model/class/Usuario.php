<?php

class Usuario {
    private $idUsuario;
    private $nomeUsuario;
    private $sobrenomeUsuario;
    private $grupo;
    private $email;
    private $senha;
    
    public function __construct($idUsuario, $nomeUsuario, $sobrenomeUsuario, 
            $grupo, $email, $senha) {
        $this->idUsuario = $idUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->sobrenomeUsuario = $sobrenomeUsuario;
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
    
    function getSobrenomeUsuario() {
        return $this->sobrenomeUsuario;
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
