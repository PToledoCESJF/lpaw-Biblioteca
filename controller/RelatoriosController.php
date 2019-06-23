<?php
require_once '../config/Global.php';

class RelatoriosController {
    
    public static function listarLivrosPorExemplares(){
        try {
            return RelatoriosDAO::listarLivrosPorExemplares();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listarExemplarPorLivro($idLivro){
        try {
            return RelatoriosDAO::listarExemplarPorLivro($idLivro);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listarEmprestimos(){
        try {
            return RelatoriosDAO::listarEmprestimos();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
        }
}
