<?php

class Exemplar {
    private $idExemplar;
    private $livro;
    private $tipoExemplar;
    private $emprestado;
    
    public function __construct($idExemplar, $livro,  $tipoExemplar) {
        $this->idExemplar = $idExemplar;
        $this->livro = $livro;
        $this->tipoExemplar = $tipoExemplar;
    }

    public function getIdExemplar() {
        return $this->idExemplar;
    }

    public function getLivro() {
        return $this->livro;
    }

    public function getTipoExemplar() {
        return $this->tipoExemplar;
    }
    
    public function getEmprestado() {
        return $this->emprestado;
    }
    
    public function setEmprestado($emprestado) {
        $this->emprestado = $emprestado;
    }
}
