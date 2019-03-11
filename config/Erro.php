<?php

class Erro
{
    public static function trataErro(Exception $exc){
        if(DEBUG){
            echo '<pre>';
            print_r($exc);
            echo '</pre>';
        }else{
            include 'erro.php';
        }
        exit;
    }
}