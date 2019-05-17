<?php

require_once '../config/Global.php';

class ExemplarDAO implements iDao {

    public static function salvar($exemplar) {
        try {
            $conexao = Conexao::conectar();
            
            if($exemplar->getIdExemplar() != NULL){
                $stmt = $conexao->prepare("UPDATE tb_exemplares SET livro = :livro, "
                        . "tipo_exemplar = :tipo_exemplar WHERE id_exemplar = :id_exemplar");
                
                $stmt->bindValue(':id_exemplar', $exemplar->getIdExemplar());
            }else{
                $stmt = $conexao->prepare("INSERT INTO tb_exemplares(livro, tipo_exemplar) "
                        . "VALUES(:livro, :tipo_exemplar)");
                
            }
            $stmt->bindValue(':livro', $exemplar->getLivro());
            $stmt->bindValue(':tipo_exemplar', $exemplar->getTipoExemplar());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function excluir($id) {
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_exemplares WHERE id_exemplar = :id_exemplar";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_exemplar', $id);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }


    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_exemplares";
            $stmt = $conexao->query($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $queryBuscaPorId = "SELECT * FROM tb_exemplares WHERE id_exemplar = :id_exemplar";
            $stmt = $conexao->prepare($queryBuscaPorId);
            $stmt->bindValue(':id_exemplar', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function tabelaDadosPorPagina($paginaAtual, $qtdRegistros) {
        try {
            $conexao = Conexao::conectar();
            $linhaInicial = ($paginaAtual - 1) * $qtdRegistros;
            $queryConsulta = "SELECT * FROM tb_exemplares LIMIT {$linhaInicial}, {$qtdRegistros}";
            $stmt = $conexao->prepare($queryConsulta);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
        
    public static function tabelaTotalDeDados(){
        try {
            $conexao = Conexao::conectar();
            $queryContador = "SELECT COUNT(*) AS total_registros FROM tb_exemplares";
            $stmtCont = $conexao->prepare($queryContador);
            $stmtCont->execute();

            return $stmtCont->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
