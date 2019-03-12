<?php

class Exemplar {
    private $id_exemplar;
    private $livro;
    private $tipo = TRUE;
    
    public function __construct($id_exemplar, Livro $livro,  $tipo) {
        $this->id_exemplar = $id_exemplar;
        $this->livro = $livro;
        $this->tipo = $tipo;
    }

    public function getId_exemplar() {
        return $this->id_exemplar;
    }

    public function getLivro() {
        return $this->livro;
    }

    public function getTipo() {
        return $this->tipo;
    }

}
