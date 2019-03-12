<?php
require_once '../config/Global.php';

$assuntoController = new AssuntoController();

$method = filter_input(INPUT_POST, 'metodo');
$id_assunto = filter_input(INPUT_POST, 'id_assunto');
$assunto = filter_input(INPUT_POST, 'assunto');

if($method == "inserir"){
    try {
        $assuntoController->inserir(new Assunto(false, $assunto));
        header('Location: ../view/assunto-lista.php');
    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }   
}

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




