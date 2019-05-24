<?php

class Livro {
    private $idLivro;
    private $titulo;
    private $isbn;
    private $edicao;
    private $ano;
    private $imagem;
    private $categoria;
    private $editora;
    private $descricao;
    
    function __construct($idLivro, $titulo, $isbn, $edicao, $ano, $imagem, $categoria, $editora, $descricao) {
        $this->idLivro = $idLivro;
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->edicao = $edicao;
        $this->ano = $ano;
        $this->imagem = $imagem;
        $this->categoria = $categoria;
        $this->editora = $editora;
        $this->descricao = $descricao;
    }
    
    function getIdLivro() {
        return $this->idLivro;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getEdicao() {
        return $this->edicao;
    }

    function getAno() {
        return $this->ano;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getEditora() {
        return $this->editora;
    }
    
    function getImagem() {
        return $this->imagem;
    }
    
    function getDescricao() {
        return $this->descricao;
    }
}    