<?php

class Atendente extends Usuario{
        
    public function __construct($id_usuario, $nome, $grupo, $email, $senha) {
        parent::__construct($id_usuario, $nome, $grupo, $email, $senha);
    }
    
    // Métodos exclusivos do Atendente
    
    public function controlarEmprestimo(){
        
    }
    
    public function controlarReserva(){
        
    }
    
    public function controlarUsuario(){
        
    }

    // Getters
    
    public function getId_usuario() {
        parent::getId_usuario();
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
