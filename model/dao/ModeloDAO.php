<?php

/*
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_() VALUES(:)";
            $this->queryListar = "SELECT * FROM tb_";
            $this->queryAtualizar = "UPDATE tb_ SET  = :, WHERE id_ = :id_";
            $this->queryExcluir = "DELETE FROM tb_ WHERE id_ = :id_";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }
    
    public function inserir( $){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':', $->get());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function listar(){
        try {
            $stmt = $this->conexao->query($this->queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function atualizar( $){
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':', $->get());
            $stmt->bindValue(':id_', $->getId_());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function excluir($id){
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}

