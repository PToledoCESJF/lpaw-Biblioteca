<?php

require_once '../config/Global.php';

class CategoriaDAO implements iDao{

    public static function inserir($categoria){
        try {
            $conexao = Conexao::conectar();
            $queryInserir = "INSERT INTO tb_categoria(nome_categoria, descricao, assunto) "
                    . "VALUES(:nome_categoria, :descricao, :assunto)";
            $stmt = $conexao->prepare($queryInserir);
            $stmt->bindValue(':nome_categoria', $categoria->getNomeCategoria());
            $stmt->bindValue(':descricao', $categoria->getDescricao());
            $stmt->bindValue(':assunto', $categoria->getAssunto());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listar(){
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_categoria";
            $stmt = $conexao->prepare($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function BuscarPorId($id){
        try {
            $this->conexao = Conexao::conectar();
            $this->queryBuscaPorId = "SELECT * FROM tb_categoria WHERE id_categoria = :id_categoria";
            $stmt = $this->conexao->prepare($this->queryBuscaPorId);
            $stmt->bindValue(':id_categoria', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function atualizar($categoria){
        try {
            $this->conexao = Conexao::conectar();
            $this->queryAtualizar = "UPDATE tb_categoria SET nome_categoria = :nome_categoria, descricao = :descricao, "
                    . "assunto = :assunto WHERE id_categoria = :id_categoria";
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':nome_categoria', $categoria->getNomeCategoria());
            $stmt->bindValue(':descricao', $categoria->getDescricao());
            $stmt->bindValue(':assunto', $categoria->getAssunto());            
            $stmt->bindValue(':id_categoria', $categoria->getIdCategoria());
            $stmt->execute();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function excluir($categoria){
        try {
            $this->conexao = Conexao::conectar();
            $this->queryExcluir = "DELETE FROM tb_categoria WHERE id_categoria = :id_categoria";
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_categoria', $categoria->getIdCategoria());
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

}
