<?php

class Livro {
    private $id_livro;
    private $titulo;
    private $isbn;
    private $autores;
    private $edicao;
    private $editora;
    private $ano;
    private $assunto;
    private $upload;
    
    public function __construct($id_livro, $titulo, $isbn, $autores, $edicao, $editora, $ano, Assunto $assunto, $upload) {
        $this->id_livro = $id_livro;
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->autores = $autores;
        $this->edicao = $edicao;
        $this->editora = $editora;
        $this->ano = $ano;
        $this->assunto = $assunto;
        $this->upload = $upload;
    }
    
    public function getId_livro() {
        return $this->id_livro;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getAutores() {
        return $this->autores;
    }

    public function getEdicao() {
        return $this->edicao;
    }

    public function getEditora() {
        return $this->editora;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getAssunto() {
        return $this->assunto;
    }

    public function getUpload() {
        return $this->upload;
    }

}
