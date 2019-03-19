<?php

interface ModelController {
    
    public function __construct();
    
    public function inserir(Classe $c);
    
    public function listar();
    
    public function atualizar(Classe $c);
    
    public function buscaPorId($id);

    public function excluir($id);
}
