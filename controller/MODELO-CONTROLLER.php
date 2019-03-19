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

class AssuntoController {
    private $assuntoDao;
    
    public function __construct() {
        $this->assuntoDao = new AssuntoDAO();
    }
    
    public function inserir(Assunto $a){
        $this->assuntoDao->inserir($a);
    }
    
    public function listar(){
        return $this->assuntoDao->listar();
    }
    
    public function atualizar(Assunto $a){
        $this->assuntoDao->atualizar($a);
    }
    
    public function buscaPorId($id_assunto){
        return $this->assuntoDao->buscaPorId($id_assunto);
        //return new Assunto($a['id_assunto'], $a['assunto']);
    }

        public function excluir($id){
        $this->assuntoDao->excluir($id);
    }
}
