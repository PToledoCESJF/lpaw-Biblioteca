<?php 

require_once '../config/Global.php';
Template::header();
    
try {
    $selecao = filter_input(INPUT_POST, 'selecao');
    
    if($selecao == 'usuarios'){
        header('Location: ../view/rel_dados_usuarios.php');
    }elseif($selecao == 'livros'){
        header('Location: ../view/rel_livros.php');
    }elseif($selecao == 'reservados'){
        header('Location: ../view/rel_livros_reservados.php');
    }elseif($selecao == 'emprestados'){
        header('Location: ../view/rel_livros_emprestados.php');
    }elseif($selecao == 'atrasos'){
        header('Location: ../view/rel_emprestimos_em_atraso.php');
    }
    
} catch (Exception $exc) {
    Erro::trataErro($exc);
}


// Para que os menus fiquem responsivos, é necessário que 
// o sidebar() venha antes do navbar()
Template::sidebar();
Template::navbar();

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 card">
                <form action="relatorios.php" method="POST">
                    <div class="card">
                        
                        <!-- Botão para Relatório de Dados de Usuários-->
                        <div class="col-lg-4">
                            <button type="submit" class="btn-link" name="selecao" 
                                    value="usuarios" 
                                    style="width: 190px; height: 235px">
                                <img class='card-img-top' 
                                     src='../assets/img/relatorios.jpg' 
                                     style="width: 100%; height: 100%; padding: 5px;" />
                            </button> 
                            <p>Dados dos Usuários</p>
                        </div>
                        <!-- Botão para Relatório de livros-->
                        <div class="col-lg-4">
                            <button type="submit" class="btn-link" name="selecao" 
                                    value="livros" 
                                    style="width: 190px; height: 235px">
                                <img class='card-img-top' 
                                     src='../assets/img/relatorios.jpg' 
                                     style="width: 100%; height: 100%; padding: 5px;" />
                            </button> 
                            <p>Livros Cadastrados</p>
                        </div>
                        <!-- Botão para Relatório de Livros Reservados-->
                        <div class="col-lg-4">
                            <button type="submit" class="btn-link" name="selecao" 
                                    value="reservados" 
                                    style="width: 190px; height: 235px">
                                <img class='card-img-top' 
                                     src='../assets/img/relatorios.jpg' 
                                     style="width: 100%; height: 100%; padding: 5px;" />
                            </button> 
                            <p>Livros Reservados</p>
                        </div>
                        <!-- Botão para Relatório de Livros Emprestados -->
                        <div class="col-lg-4">
                            <button type="submit" class="btn-link" name="selecao" 
                                    value="emprestados" 
                                    style="width: 190px; height: 235px">
                                <img class='card-img-top' 
                                     src='../assets/img/relatorios.jpg' 
                                     style="width: 100%; height: 100%; padding: 5px;" />
                            </button> 
                            <p>Livros Emprestados</p>
                        </div>
                        <!-- Botão para Relatório de Emprestimos em atraso-->
                        <div class="col-lg-4">
                            <button type="submit" class="btn-link" name="selecao" 
                                    value="atrasos" 
                                    style="width: 190px; height: 235px">
                                <img class='card-img-top' 
                                     src='../assets/img/relatorios.jpg' 
                                     style="width: 100%; height: 100%; padding: 5px;" />
                            </button> 
                            <p>Empréstimos em Atraso</p>
                        </div>
                        
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

</body>
<?php 
Template::footer();
?>
