<?php

class Emprestimo {
    private $id_exemplar;
    private $id_pessoa;
    private $data_emprestimo;
    private $observacao;
    
    function __construct($id_exemplar, $id_pessoa, $data_emprestimo, $observacao) {
        $this->id_exemplar = $id_exemplar;
        $this->id_pessoa = $id_pessoa;
        $this->data_emprestimo = $data_emprestimo;
        $this->observacao = $observacao;
    }
    
    function getId_exemplar() {
        return $this->id_exemplar;
    }

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getData_emprestimo() {
        return $this->data_emprestimo;
    }

    function getObservacao() {
        return $this->observacao;
    }

}
