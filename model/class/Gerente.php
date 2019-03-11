<?php

class Gerente extends Funcionario{
    
    public function __construct($id_pessoa, $nome, $grupo, $email, $senha, $funcao) {
        parent::__construct($id_pessoa, $nome, $grupo, $email, $senha, $funcao);
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
    
    public function getFuncao() {
        parent::getFuncao();
    }
}
