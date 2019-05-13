<?php

require_once 'Config.php';

    spl_autoload_register('carregarClasse');

    function carregarClasse($nomeClasse)
    {
        if(file_exists('../model/class/' . $nomeClasse . '.php')){
            require_once '../model/class/' . $nomeClasse . '.php';
        }elseif (file_exists('../model/dao/' . $nomeClasse . '.php')){
            require_once '../model/dao/' . $nomeClasse . '.php';
        }elseif (file_exists('../controller/' . $nomeClasse . '.php')){
            require_once '../controller/' . $nomeClasse . '.php';
        }elseif (file_exists('../config/' . $nomeClasse . '.php')){
            require_once '../config/' . $nomeClasse . '.php';
        }
    }