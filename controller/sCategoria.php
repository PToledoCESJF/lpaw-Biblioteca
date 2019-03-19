<?php

require_once '../config/Global.php';

    $method = filter_input(INPUT_POST, 'metodo');
    $idCategoria = filter_input(INPUT_POST, 'id_categoria');
    $nomeCategoria = filter_input(INPUT_POST, 'nome_categoria');
    $descricao = filter_input(INPUT_POST, 'descricao');
    $assunto = filter_input(INPUT_POST, 'assunto');
    
    $categoria = new Categoria($idCategoria, $nomeCategoria, $descricao, $assunto);
    echo '<pre>';
    print_r($categoria);
    echo '</pre>';
    $categoriaControll = new CategoriaController($method, $categoria);

    $categoriaControll->carregar();