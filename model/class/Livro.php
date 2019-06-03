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
    
    public function __construct($idLivro, $titulo, $isbn, $edicao, $ano, $imagem, $categoria, $editora, $descricao) {
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
    
    public function getIdLivro() {
        return $this->idLivro;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getEdicao() {
        return $this->edicao;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getEditora() {
        return $this->editora;
    }
    
    public function getImagem() {
        return $this->imagem;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
}    