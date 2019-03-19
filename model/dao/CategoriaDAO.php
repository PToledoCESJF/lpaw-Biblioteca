<?php

class CategoriaDAO implements ModelDao{
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public static function inserir(Categoria $categoria){
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_categoria(nome, descricao, assunto) "
                    . "VALUES(:nome, :descricao, :assunto)";
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome', $categoria->getNome());
            $stmt->bindValue(':descricao', $categoria->getDescricao());
            $stmt->bindValue(':assunto', $categoria->getAssunto());
            $stmt->execute();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listar(){
        try {
            $this->conexao = Conexao::conectar();
            $this->queryListar = "SELECT * FROM tb_categoria";
            $stmt = $this->conexao->query($this->queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function atualizar(Categoria $categoria){
        try {
            $this->conexao = Conexao::conectar();
            $this->queryAtualizar = "UPDATE tb_categoria SET nome = :nome, descricao = :descricao, "
                    . "assunto = :assunto WHERE id_categoria = :id_categoria";
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':nome', $categoria->getNome());
            $stmt->bindValue(':descricao', $categoria->getDescricao());
            $stmt->bindValue(':assunto', $categoria->getAssunto());            
            $stmt->bindValue(':id_categoria', $categoria->getId_categoria());
            $stmt->execute();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function excluir($id){
        try {
            $this->conexao = Conexao::conectar();
            $this->queryExcluir = "DELETE FROM tb_categoria WHERE id_categoria = :id_categoria";
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_categoria', $id);
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

}
