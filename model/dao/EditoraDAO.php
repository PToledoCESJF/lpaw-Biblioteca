<?php

require_once '../config/Global.php';

class EditoraDAO implements iDao{
    
    public static function salvar($editora) {
        try {
            $conexao = Conexao::conectar();
            
            if($editora->getIdEditora() != NULL){
                $stmt = $conexao->prepare("UPDATE tb_editoras SET nome_editora = :nome_editora "
                . "WHERE id_editora = :id_editora");
                
                $stmt->bindValue(':id_editora', $editora->getIdEditora());
            }else{
                $stmt = $conexao->prepare("INSERT INTO tb_editoras(nome_editora) "
                        . "VALUES(:nome_editora)");
                
            }
            $stmt->bindValue(':nome_editora', $editora->getNomeEditora());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function excluir($id) {
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_editoras WHERE id_editora = :id_editora";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_editora', $id);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }


    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_editoras";
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
            $queryBuscaPorId = "SELECT * FROM tb_editoras WHERE id_editora = :id_editora";
            $stmt = $conexao->prepare($queryBuscaPorId);
            $stmt->bindValue(':id_editora', $id);
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
            $queryConsulta = "SELECT * FROM tb_editoras LIMIT {$linhaInicial}, {$qtdRegistros}";
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
            $queryContador = "SELECT COUNT(*) AS total_registros FROM tb_editoras";
            $stmtCont = $conexao->prepare($queryContador);
            $stmtCont->execute();

            return $stmtCont->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
