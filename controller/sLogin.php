<?php

require_once '../config/Global.php';

    $method = filter_input(INPUT_POST, 'metodo');
    $id_usuario = filter_input(INPUT_POST, 'id_usuario');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'senha');
    
    $usuario = new Usuario($id_usuario, $email, $senha);

    UsuarioController::carregar($method, $usuario);
