<?php

class Livro {
    private $id_livro;
    private $titulo;
    private $isbn;
    private $edicao;
    private $ano;
    private $upload;
    private $categoria;
    private $editora;
    
    function __construct($id_livro, $titulo, $isbn, $edicao, $editora, $ano, $categoria, $upload) {
        $this->id_livro = $id_livro;
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->edicao = $edicao;
        $this->ano = $ano;
        $this->upload = $upload;
        $this->categoria = $categoria;
        $this->editora = $editora;
    }
    
    function getId_livro() {
        return $this->id_livro;
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
}    