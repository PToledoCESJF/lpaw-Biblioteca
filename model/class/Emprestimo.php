<?php

class Emprestimo {
    private $idEmprestimo;
    private $usuario;
    private $observacao;
    
    public function __construct($idEmprestimo, $usuario, $observacao) {
        $this->idEmprestimo = $idEmprestimo;
        $this->usuario = $usuario;
        $this->observacao = $observacao;
    }
    
    function getIdEmprestimo() {
        return $this->idEmprestimo;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getObservacao() {
        return $this->observacao;
    }

}
