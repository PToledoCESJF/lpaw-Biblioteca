<?php

class Atendente extends Funcionario{
        
    public function __construct($id_pessoa, $nome, $grupo, $email, $senha, $funcao) {
        parent::__construct($id_pessoa, $nome, $grupo, $email, $senha, $funcao);
    }
    
    // Métodos exclusivos do Atendente
    
    public function controlarEmprestimo(){
        
    }
    
    public function controlarReserva(){
        
    }
    
    public function controlarUsuario(){
        
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
