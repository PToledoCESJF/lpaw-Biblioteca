<?php

require_once '../config/Global.php';

    $method = filter_input(INPUT_POST, 'metodo');
    $id_categoria = filter_input(INPUT_POST, 'id_categoria');
    $nome_categoria = filter_input(INPUT_POST, 'nome_categoria');
    $descricao = filter_input(INPUT_POST, 'descricao');
    $assunto = filter_input(INPUT_POST, 'assunto');

    if($method == "inserir"){
        try {
            $id_categoria = false;
            $categoria = new Categoria($id_categoria, $nome_categoria, $descricao, $assunto);
            CategoriaDAO::inserir($categoria);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }   
    }

header('Location: ../view/categoria-lista.php');

    if($method == "atualizar"){
        try {
            $assuntoController->atualizar(new Assunto($id_assunto, $assunto));
            header('Location: ../view/assunto-lista.php');
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    if($method == "excluir"){
        try {
            $assuntoController->excluir($id_assunto);
            header('Location: ../view/assunto-lista.php');
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

class CategoriaController implements ModelController{    

    public function __construct() {
        
    }

    public function atualizar(\Classe $c) {
        
    }

    public function buscaPorId($id) {
        
    }

    public function excluir($id) {
        
    }

    public function inserir(\Classe $c) {
        
    }

    public function listar() {
        
    }

}
