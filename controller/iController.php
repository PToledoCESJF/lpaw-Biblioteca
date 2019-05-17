<?php

interface iController {
    
    public static function carregarVazio();
    
    public static function salvar($surce);
    
    public static function listar();
        
    public static function buscaPorId($id);

    public static function excluir($id);
    
    public static function retornar();
}
