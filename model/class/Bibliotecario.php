<?php

class Bibliotecario extends Usuario{
    
    public function __construct($id_pessoa, $nome, $grupo, $email, $senha) {
        parent::__construct($id_pessoa, $nome, $grupo, $email, $senha);
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
    
    public function getId_pessoa() {
        parent::getId_pessoa();
    }
    
    public function getNome() {
        parent::getNome();
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
