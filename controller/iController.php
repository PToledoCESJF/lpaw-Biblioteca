<?php

interface iController {
    
    public static function carregar($method, $source);
    
    public static function salvar($surce);
    
    public static function listar();
        
    public static function buscaPorId($id);

    public static function excluir($surce);
    
    public static function retornar();
}
