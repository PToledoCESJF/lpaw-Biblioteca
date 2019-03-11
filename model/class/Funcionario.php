<?php

class Funcionario extends Pessoa{
    private $email;
    private $senha;
    private $funcao;
    
    public function __construct($id_pessoa, $nome, $grupo, $email, $senha, $funcao) {
        parent::__construct($id_pessoa, $nome, $grupo);
        $this->email = $email;
        $this->senha = $senha;
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
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getFuncao() {
        return $this->funcao;
    }

}
