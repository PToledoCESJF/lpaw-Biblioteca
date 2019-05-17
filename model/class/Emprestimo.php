<?php

class Emprestimo {
    private $exemplar;
    private $usuario;
    private $dataEmprestimo;
    private $observacao;
    
    function __construct($exemplar, $usuario, $dataEmprestimo, $observacao) {
        $this->exemplar = $exemplar;
        $this->usuario = $usuario;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->observacao = $observacao;
    }
    
    function getExemplar() {
        return $this->exemplar;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getDataEmprestimo() {
        return $this->dataEmprestimo;
    }

    function getObservacao() {
        return $this->observacao;
    }

}
