<?php

class Funcionario extends Pessoa{
    private $funcao;
    
    public function __construct($id_pessoa, $nome, $grupo, $email, $senha, $funcao) {
        parent::__construct($id_pessoa, $nome, $grupo, $email, $senha);
        $this->funcao = $funcao;
    }
    
    // Getters
    
    public function getId_pessoa() {
        return parent::getId_pessoa();
    }

    public function getNome() {
        return parent::getNome();
    }

    public function getGrupo() {
        return parent::getGrupo();
    }
    
    public function getEmail() {
        return parent::getEmail();
    }

    public function getSenha() {
        return parent::getSenha();
    }

    public function getFuncao() {
        return $this->funcao;
    }

}
