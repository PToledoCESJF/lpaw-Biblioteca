<?php

class Usuario {
    private $id_usuario;
    private $email;
    private $senha;
    
    public function __construct($id_usuario, $email, $senha) {
        $this->id_usuario = $id_usuario;
        $this->email = $email;
        $this->senha = $senha;
        
    }
    
    public function consultarAcervo($pesquisa){
        
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }
}
