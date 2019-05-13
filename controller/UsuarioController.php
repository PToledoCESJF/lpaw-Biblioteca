<?php

require_once '../config/Global.php';

class UsuarioController implements iController{
    

    public static function carregar($method, $usuario) {
            if($method === "inserir"){
            self::inserir($usuario);
        }elseif ($method === "atualizar") {
            self::atualizar($usuario);
        }elseif($method === "listar"){
            self::listar();
        }elseif($method === "excluir") {
            self::excluir($usuario);
        }elseif($method === "usuario_logado") {
            self::excluir($usuario);
        }
    }
    
    public static function usuarioLogado() {
    //    return $_SESSION["usuario_logado"];
        return filter_input(INPUT_POST, 'usuario_logado');
    }
    
    public static function atualizar($usuario) {
        
    }

    public static function buscaPorId($id) {
        
    }


    public static function excluir($usuario) {
        
    }

    public static function inserir($usuario) {
        
    }

    public static function listar() {
        
    }

    public static function retornar() {
        
    }

}