<?php

require_once '../config/Global.php';

class CategoriaDAO implements iDao{

    public static function salvar($categoria){
        try {
            $conexao = Conexao::conectar();
            
            if($categoria->getIdCategoria() != NULL){
                $stmt = $conexao->prepare("UPDATE tb_categorias SET nome_categoria = :nome_categoria, "
                    . "assunto = :assunto WHERE id_categoria = :id_categoria");
                $stmt->bindValue(':id_categoria', $categoria->getIdCategoria());
            } else {
                $stmt = $conexao->prepare("INSERT INTO tb_categorias(nome_categoria, assunto) "
                        . "VALUES(:nome_categoria, :assunto)");
            }
            $stmt->bindValue(':nome_categoria', $categoria->getNomeCategoria());
            $stmt->bindValue(':assunto', $categoria->getAssunto());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listar(){
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_categorias";
            $stmt = $conexao->prepare($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function BuscarPorId($id){
        try {
            $conexao = Conexao::conectar();
            $queryBuscaPorId = "SELECT * FROM tb_categorias WHERE id_categoria = :id_categoria";
            $stmt = $conexao->prepare($queryBuscaPorId);
            $stmt->bindValue(':id_categoria', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function excluir($idCategoria){
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_categorias WHERE id_categoria = :id_categoria";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_categoria', $idCategoria);
            $stmt->execute();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function tabelaDadosPorPagina($paginaAtual, $qtdRegistros){
        try {
            $conexao = Conexao::conectar();
            $linhaInicial = ($paginaAtual - 1) * $qtdRegistros;
            $queryConsulta = "SELECT * FROM tb_categorias LIMIT {$linhaInicial}, {$qtdRegistros}";
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
            $queryContador = "SELECT COUNT(*) AS total_registros FROM tb_categorias";
            $stmtCont = $conexao->prepare($queryContador);
            $stmtCont->execute();

            return $stmtCont->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
}
