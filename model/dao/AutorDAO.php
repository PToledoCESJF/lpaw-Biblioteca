<?php

require_once '../config/Global.php';

class AutorDAO implements iDao{
    
    public static function salvar($autor) {
        try {
            $conexao = Conexao::conectar();
            
            if($autor->getIdAutor() != NULL){
                $stmt = $conexao->prepare("UPDATE tb_autores SET nome_autor = :nome_autor "
                        . "WHERE id_autor = :id_autor");
                
                $stmt->bindValue(':id_autor', $autor->getIdAutor());
            } else {
                $stmt = $conexao->prepare("INSERT INTO tb_autores(nome_autor) VALUES(:nome_autor)");
            }
            $stmt->bindValue(':nome_autor', $autor->getNomeAutor());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }


    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("SELECT * FROM tb_autores");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("SELECT * FROM tb_autores WHERE id_autor = :id_autor");
            $stmt->bindValue(':id_autor', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function excluir($id) {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("DELETE FROM tb_autores WHERE id_autor = :id_autor");
            $stmt->bindValue(':id_autor', $id);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function tabelaDadosPorPagina($paginaAtual, $qtdRegistros){
        try {
            $conexao = Conexao::conectar();
            $linhaInicial = ($paginaAtual - 1) * $qtdRegistros;
            $queryConsulta = "SELECT * FROM tb_autores LIMIT {$linhaInicial}, {$qtdRegistros}";
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
            $queryContador = "SELECT COUNT(*) AS total_registros FROM tb_autores";
            $stmtCont = $conexao->prepare($queryContador);
            $stmtCont->execute();

            return $stmtCont->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
