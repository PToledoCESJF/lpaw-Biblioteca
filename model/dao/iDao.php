<?php

interface iDao{
    
    public static function inserir($source);
        
    public static function listar();
            
    public static function atualizar($source);
    
    public static function excluir($source);
    
    public static function BuscarPorId($id);
}

