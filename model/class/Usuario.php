<?php

class Usuario extends Pessoa{
    
    
    public function __construct($id_pessoa, $nome, $grupo) {
        parent::__construct($id_pessoa, $nome, $grupo);
        
    }
    
    // Método exclusivo de usuários
    
    public function consultarAcervo($pesquisa){
        
    }

    
    // Métodos Getters
    
    public function getId_pessoa() {
        return parent::getId_pessoa();
    }

    public function getNome() {
        return parent::getNome();
    }
    
    public function getGrupo() {
        return parent::getGrupo();
    }

}
