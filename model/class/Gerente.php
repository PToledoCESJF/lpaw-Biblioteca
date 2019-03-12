<?php

class Gerente extends Usuario{
    
    public function __construct($id_pessoa, $nome, $grupo, $email, $senha) {
        parent::__construct($id_pessoa, $nome, $grupo, $email, $senha);
    }
    
    // Método exclusivo de Gerente
    
    public function gerarRelatorioAquisicaoLivro() {
        
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
