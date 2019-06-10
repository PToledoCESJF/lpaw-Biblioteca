<?php

class Emprestimo {
    private $idEmprestimo;
    private $exemplar;
    private $usuario;
    private $dataEmprestimo;
    private $dataDevolucao;
    private $observacao;
    
    public function __construct($idEmprestimo, $exemplar, $usuario, $dataEmprestimo, $dataDevolucao, $observacao) {
        $this->idEmprestimo = $idEmprestimo;
        $this->exemplar = $exemplar;
        $this->usuario = $usuario;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
        $this->observacao = $observacao;
    }
    
    function getIdEmprestimo() {
        return $this->idEmprestimo;
    }

    public function getExemplar() {
        return $this->exemplar;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getDataEmprestimo() {
        return $this->dataEmprestimo;
    }

    function getDataDevolucao() {
        return $this->dataDevolucao;
    }

    public function getObservacao() {
        return $this->observacao;
    }

}
