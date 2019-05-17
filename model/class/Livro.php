<?php

class Livro {
    private $idLivro;
    private $titulo;
    private $isbn;
    private $edicao;
    private $ano;
    private $imagem;
    private $upload;
    private $categoria;
    private $editora;
    
    function __construct($idLivro, $titulo, $isbn, $edicao, $editora, $ano, $categoria, $imagem, $upload) {
        $this->idLivro = $idLivro;
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->edicao = $edicao;
        $this->ano = $ano;
        $this->imagem = $imagem;
        $this->upload = $upload;
        $this->categoria = $categoria;
        $this->editora = $editora;
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

    function getUpload() {
        return $this->upload;
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


}    