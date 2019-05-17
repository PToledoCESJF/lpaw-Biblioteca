<?php

require_once '../config/Global.php';

class UsuarioController implements iController{
    
    public static function usuarioLogado() {
    //    return $_SESSION["usuario_logado"];
        return filter_input(INPUT_POST, 'usuario_logado');
    }

    public static function carregar($method, $usuario) {
            if($method === "salvar"){
            self::salvar($usuario);
        }
    }
    
    public static function carregarVazio() {
        return new Usuario(NULL, NULL, NULL, NULL, NULL);
    }

    public static function buscaPorId($id) {
        $stmt = UsuarioDAO::BuscarPorId($id);
        return new Usuario($stmt['idUsuario'], $stmt['nomeUsuario'], $stmt['grupo'], 
                $stmt['email'], $stmt['senha']);
    }


    public static function excluir($id) {
        UsuarioDAO::excluir($id);
        self::retornar();
    }

    public static function listar() {
        return UsuarioDAO::listar();
    }

    public static function retornar() {
        header('Location: ../view/usuario.php');
    }

    public static function salvar($usuario) {
        try {
            UsuarioDAO::salvar($usuario);
            self::retornar();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

}