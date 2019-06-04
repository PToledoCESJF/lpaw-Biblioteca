<?php

class LivroAutorDAO{
    
    public static function BuscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("SELECT * FROM tb_livros_autores WHERE id_livro_autor = :id_livro_autor");
            $stmt->bindValue(':id_livro_autor', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function excluir($id) {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("DELETE FROM tb_livros_autores WHERE id_livro_autor = :id_livro_autor");
            $stmt->bindValue(':id_livro_autor', $id);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("SELECT * FROM tb_livros_autores");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function salvar($idLivroAutor, $livro, $autor) {
        try {
            $conexao = Conexao::conectar();
            
            foreach ($autor as $linha) {

                if($idLivroAutor != NULL){
                    $stmt = $conexao->prepare("UPDATE tb_livros_autores SET livro = :livro, "
                            . "autor = :autor WHERE id_livro_autor = :id_livro_autor");

                    $stmt->bindValue(':id_livro_autor', $idLivroAutor);
                } else {
                    $stmt = $conexao->prepare("INSERT INTO tb_livros_autores(livro, autor) VALUES(:livro, :autor)");
                }
                $stmt->bindValue(':livro', $livro);
                $stmt->bindValue(':autor', $linha);
                $stmt->execute();
            }
            
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

}
