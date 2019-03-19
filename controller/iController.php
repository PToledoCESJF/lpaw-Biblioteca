<?php

interface iController {
    
    public function __construct($method, $source);

    public function carregar();
    
    public static function inserir($surce);
    
    public static function listar();
    
    public static function atualizar($surce);
    
    public static function buscaPorId($id);

    public static function excluir($surce);
    
    public static function retornar();
}
