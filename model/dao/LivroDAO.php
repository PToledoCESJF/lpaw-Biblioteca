<?php

require_once '../config/Global.php';

class LivroDAO implements iDao{
    
    public static function inserir($livro){
        try {
            $conexao = Conexao::conectar();
            $queryInserir = "INSERT INTO tb_livro(titulo, isbn, edicao, ano, "
                    . "upload, categoria, editora) VALUES(:titulo, :isbn, :edicao, "
                    . ":ano, :upload, :categoria, :editora)";
            $stmt = $conexao->prepare($queryInserir);
            $stmt->bindValue(':titulo', $livro->getTitulo());
            $stmt->bindValue(':isbn', $livro->getIsbn());
            $stmt->bindValue(':edicao', $livro->getEdicao());
            $stmt->bindValue(':ano', $livro->getAno());
            $stmt->bindValue(':upload', $livro->getUpload());
            $stmt->bindValue(':categoria', $livro->getCategoria());
            $stmt->bindValue(':editora', $livro->getEditora());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listar(){
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_livro";
            $stmt = $conexao->query($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function atualizar($livro){
        try {
            $conexao = Conexao::conectar();
            $queryAtualizar = "UPDATE tb_livro SET  titulo = :titulo, isbn = :isbn, "
                    . "edicao = :edicao, ano = :ano, upload = :upload, categoria = :categoria, "
                    . "editora = :editora WHERE id_livro = :id_livro";
            $stmt = $conexao->prepare($queryAtualizar);
            $stmt->bindValue(':titulo', $livro->getTitulo());
            $stmt->bindValue(':isbn', $livro->getIsbn());
            $stmt->bindValue(':edicao', $livro->getEdicao());
            $stmt->bindValue(':ano', $livro->getAno());
            $stmt->bindValue(':upload', $livro->getUpload());
            $stmt->bindValue(':categoria', $livro->getCategoria());
            $stmt->bindValue(':editora', $livro->getEditora());
            $stmt->bindValue(':id_livro', $livro->getId_livro());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function excluir($id){
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_livro WHERE id_livro = :id_livro";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_livro', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        
    }

}