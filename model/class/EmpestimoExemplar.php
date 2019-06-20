<?php

class EmpestimoExemplar {
    private $idEmprestimoExemplar;
    private $emprestimo;
    private $livro;
    private $exemplar;
    
    public function __construct($idEmprestimoExemplar, $emprestimo, $livro, $exemplar) {
        $this->idEmprestimoExemplar = $idEmprestimoExemplar;
        $this->emprestimo = $emprestimo;
        $this->livro = $livro;
        $this->exemplar = $exemplar;
    }

    public function getIdEmprestimoExemplar() {
        return $this->idEmprestimoExemplar;
    }

    public function getEmprestimo() {
        return $this->emprestimo;
    }

    public function getLivro() {
        return $this->livro;
    }

    public function getExemplar() {
        return $this->exemplar;
    }

}
