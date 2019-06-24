<?php

class RelatoriosDAO {
    public static function listarLivrosPorExemplares() {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->query("SELECT li.id_livro, li.titulo, li.imagem, ex.id_exemplar "
                    . "FROM `tb_livros` AS li "
                    . "INNER JOIN tb_exemplares AS ex "
                    . "ON li.id_livro = ex.livro");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listarExemplarPorLivro($idLivro){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->query("SELECT * FROM tb_exemplares WHERE livro = :livro");
            $stmt->bindValue(':livro', $idLivro);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listarEmprestimos(){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->query("SELECT emex.exemplar, emex.data_emprestimo, "
                    . "emex.data_reserva, emex.data_devolucao, ex.emprestado, "
                    . "e.usuario, u.nome_usuario, u.sobrenome_usuario, li.titulo "
                    . "FROM tb_emprestimos_exemplares AS emex "
                    . "INNER JOIN tb_livros AS li ON emex.livro = li.id_livro "
                    . "INNER JOIN tb_emprestimos AS e ON emex.emprestimo = e.id_emprestimo "
                    . "INNER JOIN tb_usuarios AS u ON e.usuario = u.id_usuario "
                    . "INNER JOIN tb_exemplares AS ex ON ex.id_exemplar = emex.exemplar "
                    . "ORDER BY emex.data_reserva");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
        
    }
    public static function listarReservas(){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->query("SELECT emex.exemplar, emex.data_emprestimo, "
                . "emex.data_reserva, emex.data_devolucao, e.usuario, u.nome_usuario, "
                . "u.sobrenome_usuario, li.titulo "
                . "FROM tb_emprestimos_exemplares AS emex "
                . "INNER JOIN tb_livros AS li ON emex.livro = li.id_livro "
                . "INNER JOIN tb_emprestimos AS e ON emex.emprestimo = e.id_emprestimo "
                . "INNER JOIN tb_usuarios AS u ON e.usuario = u.id_usuario "
                . "ORDER BY emex.data_reserva");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
        
    }
}
