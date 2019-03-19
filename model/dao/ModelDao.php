<?php

interface ModelDao{
    
    public function inserir(Classe $c);
        
    public function listar();
            
    public function atualizar(Classe $c);
    
    public function excluir($id);
}

