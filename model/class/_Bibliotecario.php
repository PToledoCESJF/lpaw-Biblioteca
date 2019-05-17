<?php

class Bibliotecario extends Usuario{
    
    public function __construct($idUsuario, $nomeUsuario, $grupo, $email, $senha) {
        parent::__construct($$idUsuario, $nomeUsuario, $grupo, $email, $senha);
    }
    
    // Métodos exclusivos de Bibliotecario
    
    public function cadastrarLivro(){
        
    }
    
    public function cadastrarExemplar(){
        
    }
    
    public function cadastrarCategoria(){
        
    }
    
    public function cadastrarAssunto(){
        
    }

    // Getters
    
    public function getIdUsuario() {
        parent::getIdUsuario();
    }
    
    public function getNomeUsuario() {
        parent::getNomeUsuario();
    }
    
    public function getGrupo() {
        parent::getGrupo();
    }
    
    public function getEmail() {
        parent::getEmail();
    }
    
    public function getSenha() {
        parent::getSenha();
    }
}
