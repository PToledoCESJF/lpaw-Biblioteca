<?php

class CategoriaDAO implements ModelDao{
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_categoria(nome, descricao, assunto) "
                    . "VALUES(:nome, :descricao, :assunto)";
            $this->queryListar = "SELECT * FROM tb_categoria";
            $this->queryAtualizar = "UPDATE tb_categoria SET nome = :nome, descricao = :descricao, "
                    . "assunto = :assunto WHERE id_categoria = :id_categoria";
            $this->queryExcluir = "DELETE FROM tb_categoria WHERE id_categoria = :id_categoria";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }
    
    public function inserir(Categoria $categoria){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome', $categoria->getNome());
            $stmt->bindValue(':descricao', $categoria->getDescricao());
            $stmt->bindValue(':assunto', $categoria->getAssunto());
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
    
    public function atualizar(Categoria $categoria){
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':nome', $categoria->getNome());
            $stmt->bindValue(':descricao', $categoria->getDescricao());
            $stmt->bindValue(':assunto', $categoria->getAssunto());            
            $stmt->bindValue(':id_categoria', $categoria->getId_categoria());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function excluir($id){
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_categoria', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
