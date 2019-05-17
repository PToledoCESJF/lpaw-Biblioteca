<?php

class Gerente extends Usuario{
    
    public function __construct($idUsuario, $nomeUsuario, $grupo, $email, $senha) {
        parent::__construct($idUsuario, $nomeUsuario, $grupo, $email, $senha);
    }
    
    // Método exclusivo de Gerente
    
    public function gerarRelatorioAquisicaoLivro() {
        
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
