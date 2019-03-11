<?php

class Exemplar {
    private $id_exemplar;
    private $livro;
    private $circular = TRUE;
    private $numero;
    
    public function __construct($id_exemplar, Livro $livro,  $circular, $numero) {
        $this->id_exemplar = $id_exemplar;
        $this->livro = $livro;
        $this->circular = $circular;
        $this->numero = $numero;
    }

    public function getId_exemplar() {
        return $this->id_exemplar;
    }

    public function getLivro() {
        return $this->livro;
    }

    public function getCircular() {
        return $this->circular;
    }

    public function getNumero() {
        return $this->numero;
    }

}
