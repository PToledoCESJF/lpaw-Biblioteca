<?php

interface iDao{
    
    public static function salvar($source);
        
    public static function listar();
            
    public static function excluir($id);
    
    public static function BuscarPorId($id);
   
}

