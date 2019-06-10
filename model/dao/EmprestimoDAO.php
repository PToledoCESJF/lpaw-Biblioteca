<?php

require_once '../config/Global.php';

class EmprestimoDAO {
 
    public static function reserva($reserva){
        try {
            $conexao = Conexao::conectar();
            if($emprestimo->getIdEmprestimo() != NULL){
                $stmt = $conexao->prepare("UPDATE tb_emprestimo SET exemplar = :exemplar, "
                        . "usuario = :usuario, observacao = :observacao "
                        . "WHERE = id_emprestimo :id_emprestimo");
                
                $stmt->bindValue(':id_emprestimo', $emprestimo->getIdEmprestimo());
            } else {
                $stmt = $conexao->prepare("INSERT INTO tb_emprestimo(exemplar, usuario, observacao) "
                        . "VALUES(:exemplar, :usuario, :observacao)");
            }
            $stmt->bindValue(':exemplar', $emprestimo->getExemplar());
            $stmt->bindValue(':usuario', $emprestimo->getUsuario());
            $stmt->bindValue(':observacao', $emprestimo->getObservacao());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function emprestar($emprestimo){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("UPDATE tb_emprestimo SET data_emprestimo = :data_emprestimo "
                    . "WHERE = id_emprestimo :id_emprestimo");

            $stmt->bindValue(':data_emprestimo', $emprestimo->getDataEmprestimo());
            $stmt->bindValue(':id_emprestimo', $emprestimo->getIdEmprestimo());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function renovarEmprestimo($emprestimo){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("INSERT INTO tb_emprestimo(exemplar, usuario, "
                    . "data_emprestimo observacao) "
                    . "VALUES(:exemplar, :usuario, :data_emprestimo, :observacao)");
            $stmt->bindValue(':exemplar', $emprestimo->getExemplar());
            $stmt->bindValue(':usuario', $emprestimo->getUsuario());
            $stmt->bindValue(':data_emprestimo', $emprestimo->getDataEmprestimo());
            $stmt->bindValue(':observacao', $emprestimo->getObservacao());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function devolver($emprestimo){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("UPDATE tb_emprestimo SET data_devolucao = :data_devolucao "
                    . "WHERE = id_emprestimo :id_emprestimo");

            $stmt->bindValue(':data_devolucao', $emprestimo->getDataDevolucao());
            $stmt->bindValue(':id_emprestimo', $emprestimo->getIdEmprestimo());
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
        try {
            $conexao = Conexao::conectar();
            $queryBuscaPorId = "SELECT * FROM tb_emprestimo WHERE id_emprestimo = :id_emprestimo";
            $stmt = $conexao->prepare($queryBuscaPorId);
            $stmt->bindValue(':id_emprestimo', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

}
