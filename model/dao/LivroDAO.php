<?php

require_once '../config/Global.php';

class LivroDAO implements iDao{
    
    public static function salvar($livro) {
        try {
            $conexao = Conexao::conectar();
            
            if($livro->getIdLivro() != NULL){
                $stmt = $conexao->prepare("UPDATE tb_livros SET  titulo = :titulo, isbn = :isbn, "
                        . "edicao = :edicao, ano = :ano, categoria = :categoria, "
                        . "editora = :editora, imagem = :imagem, descricao = :descricao "
                        . "WHERE id_livro = :id_livro");

                $stmt->bindValue(':id_livro', $livro->getIdLivro());
                
            } else {
                $stmt = $conexao->prepare("INSERT INTO tb_livros(titulo, isbn, edicao, "
                        . "ano, categoria, editora, imagem, descricao) "
                        . "VALUES(:titulo, :isbn, :edicao, :ano, :categoria, "
                        . ":editora, :imagem, :descricao)");
            }
            
            $stmt->bindValue(':titulo', $livro->getTitulo());
            $stmt->bindValue(':isbn', $livro->getIsbn());
            $stmt->bindValue(':edicao', $livro->getEdicao());
            $stmt->bindValue(':ano', $livro->getAno());
            $stmt->bindValue(':categoria', $livro->getCategoria());
            $stmt->bindValue(':editora', $livro->getEditora());
            $stmt->bindValue(':imagem', $livro->getImagem());
            $stmt->bindValue(':descricao', $livro->getDescricao());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listar(){
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_livros";
            $stmt = $conexao->query($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
        public static function excluir($id){
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_livros WHERE id_livro = :id_livro";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_livro', $id);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $queryBuscaPorId = "SELECT * FROM tb_livros WHERE id_livro = :id_livro";
            $stmt = $conexao->prepare($queryBuscaPorId);
            $stmt->bindValue(':id_livro', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }


    public static function tabelaDadosPorPagina($paginaAtual, $qtdRegistros){
        try {
            $conexao = Conexao::conectar();
            $linhaInicial = ($paginaAtual - 1) * $qtdRegistros;
            $queryConsulta = "SELECT * FROM tb_livros LIMIT {$linhaInicial}, {$qtdRegistros}";
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
            $queryContador = "SELECT COUNT(*) AS total_registros FROM tb_livros";
            $stmtCont = $conexao->prepare($queryContador);
            $stmtCont->execute();

            return $stmtCont->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}