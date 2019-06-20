<?php
    
require_once '../config/Global.php';
Template::header();

try {

    $method = filter_input(INPUT_GET, 'metodo');
    
    if($method == 'logout'){
        $_SESSION['usuario_id'] = 0;
        $_SESSION['usuario_nome'] = 'Visitante';
        $_SESSION['usuario_grupo'] = 0;
        $_SESSION['usuario_logado'] = FALSE;
        $_SESSION['livro_id'] = 0;
        header('Location: ../view/index.php');

    }
} catch (Exception $exc) {
    Erro::trataErro($exc);
}

// Para que os menus fiquem responsivos, é necessário que 
// o sidebar() venha antes do navbar()
Template::sidebar();
Template::navbar();
    
?>