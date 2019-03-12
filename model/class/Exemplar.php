<?php

class Exemplar {
    private $id_exemplar;
    private $livro;
    private $tipo = TRUE;
    private $numero;
    
    public function __construct($id_exemplar, Livro $livro,  $tipo, $numero) {
        $this->id_exemplar = $id_exemplar;
        $this->livro = $livro;
        $this->tipo = $tipo;
        $this->numero = $numero;
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

    public function getNumero() {
        return $this->numero;
    }

}
