<?php

require_once '../config/Global.php';

class EmprestimoDAO implements iDao{
 
    public static function atualizar($emprestimo) {
        try {
            $conexao = Conexao::conectar();
            $queryAtualizar = "UPDATE tb_emprestimo SET exemplar = :exemplar, "
                    . "usuario = :usuario, data_emprestimo = :data_emprestimo, "
                    . "observacao = :observacao WHERE = id_emprestimo :id_emprestimo";
            $stmt = $conexao->prepare($queryAtualizar);
            $stmt->bindValue(':exemplar', $emprestimo->getExemplar());
            $stmt->bindValue(':usuario', $emprestimo->getUsuario());
            $stmt->bindValue(':data_emprestimo', $emprestimo->getData_emprestimo());
            $stmt->bindValue(':observacao', $emprestimo->getObservacao());
            $stmt->bindValue(':id_emprestimo', $emprestimo->getId_emprestimo());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function excluir($id) {
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_emprestimo WHERE = :id";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function inserir($emprestimo) {
        try {
            $conexao = Conexao::conectar();
            $queryInserir = "INSERT INTO tb_emprestimo(exemplar, usuario, "
            . "data_emprestimo, observacao) VALUES(:exemplar, :usuario, "
            . ":data_emprestimo, :observacao)";
            $stmt = $conexao->prepare($queryInserir);
            $stmt->bindValue(':exemplar', $emprestimo->getExemplar());
            $stmt->bindValue(':usuario', $emprestimo->getUsuario());
            $stmt->bindValue(':data_emprestimo', $emprestimo->getData_emprestimo());
            $stmt->bindValue(':observacao', $emprestimo->getObservacao());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_emprestimo";
            $stmt = $conexao->prepare($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        
    }

}
