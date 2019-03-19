<?php
require_once 'Global.php';

class Conexao{

    private static $conexao;

    public static function conectar(){
        if(!isset(self::$conexao)){
            try{
                $conexao = new PDO(DB_DRIVE .  ':host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexao;
            } catch (PDOException $exc){
                Erro::trataErro($exc);
                exit(1);
            }
        }
    }
}