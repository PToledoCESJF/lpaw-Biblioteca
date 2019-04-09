<?php

require_once '../config/Global.php';

class AutoresDAO implements iDao{
    
    public static function atualizar(Autores $autores) {
        try {
            $conexao = Conexao::conectar();
            $queryAtualizar = "UPDATE tb_autores SET nome_autor = :nome_autor, WHERE id_autores = :id_autores";
            $stmt = $conexao->prepare($queryAtualizar);
            $stmt->bindValue(':nome_autor', $autores->getNome_autor());
            $stmt->bindValue(':id_autores', $autores->getId_autores());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function excluir($id) {
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_autores WHERE id_autores = :id_autores";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_autores', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function inserir(Autores $autores) {
        try {
            $conexao = Conexao::conectar();
            $queryInserir = "INSERT INTO tb_autores(nome_autor) VALUES(:nome_autor)";
            $stmt = $conexao->prepare($queryInserir);
            $stmt->bindValue(':nome_autor', $autores->getNome_autor());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_autores";
            $stmt = $conexao->query($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        
    }

}
