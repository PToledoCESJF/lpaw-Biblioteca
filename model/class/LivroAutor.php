<?php

class LivroAutor {
    private $idLivroAutor;
    private $livro;
    private $autor;
    
    function __construct($idLivroAutor, $livro, $autor) {
        $this->idLivroAutor = $idLivroAutor;
        $this->livro = $livro;
        $this->autor = $autor;
    }
    
    function getIdLivroAutor() {
        return $this->idLivroAutor;
    }

    function getLivro() {
        return $this->livro;
    }

    function getAutor() {
        return $this->autor;
    }
}
