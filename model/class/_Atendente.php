<?php

class Atendente extends Usuario{
        
    public function __construct($idUsuario, $nomeUsuario, $grupo, $email, $senha) {
        parent::__construct($idUsuario, $nomeUsuario, $grupo, $email, $senha);
    }
    
    // Métodos exclusivos do Atendente
    
    public function controlarEmprestimo(){
        
    }
    
    public function controlarReserva(){
        
    }
    
    public function controlarUsuario(){
        
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
