<?php

class LivroAutorController implements iController{
    public static function carregar($idLivroAutor, $livro, $autor) {
        $livorAutor = new LivroAutor($idLivroAutor, $livro, $autor);
        self::salvar($livorAutor);
    }

    public static function carregarVazio() {
        return new LivroAutor(NULL, NULL, NULL);
    }
    
    public static function buscaPorId($id) {
        $stmt = LivroAutorDAO::BuscarPorId($id);
        return new Autor($stmt['id_livro_autor'], $stmt['livro'], $stmt['autor']);
    }


    public static function excluir($id) {
        LivroAutorDAO::excluir($id);
        self::retornar();
    }

    public static function listar() {
        return LivroAutorDAO::listar();
    }

    public static function retornar() {
        header('Location: ../view/autor.php');
    }

    public static function salvar($livroAutor) {
        LivroAutorDAO::salvar($livroAutor);
        self::retornar();
    }

}
