<?php

require_once '../config/Global.php';

class ExemplarDAO implements iDao {

    public static function inserir($exemplar){
        try {
            $conexao = Conexao::conectar();
            $queryInserir = "INSERT INTO tb_exemplar(livro, tipo) "
                    . "VALUES(:livro, :tipo)";
            $stmt = $conexao->prepare($queryInserir);
            $stmt->bindValue(':livro', $exemplar->getLivro());
            $stmt->bindValue(':tipo', $exemplar->getTipo());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listar(){
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_exemplar";
            $stmt = $conexao->query($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function atualizar($exemplar){
        try {
            $conexao = Conexao::conectar();
            $queryAtualizar = "UPDATE tb_exemplar SET livro = :livro, "
                    . "tipo = :tipo WHERE id_exemplar = :id_exemplar";
            $stmt = $conexao->prepare($queryAtualizar);
            $stmt->bindValue(':livro', $exemplar->getLivro());
            $stmt->bindValue(':tipo', $exemplar->getTipo());
            $stmt->bindValue(':id_exemplar', $exemplar->getId_exemplar());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function excluir($id){
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_exemplar WHERE id_exemplar = :id_exemplar";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_exemplar', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        
    }

}
