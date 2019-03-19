<?php

class Emprestimo {
    private $exemplar;
    private $usuario;
    private $data_emprestimo;
    private $observacao;
    
    function __construct($exemplar, $usuario, $data_emprestimo, $observacao) {
        $this->exemplar = $exemplar;
        $this->usuario = $usuario;
        $this->data_emprestimo = $data_emprestimo;
        $this->observacao = $observacao;
    }
    
    function getExemplar() {
        return $this->exemplar;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getData_emprestimo() {
        return $this->data_emprestimo;
    }

    function getObservacao() {
        return $this->observacao;
    }

}
