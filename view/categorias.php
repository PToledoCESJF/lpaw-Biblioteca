<?php
    
require_once '../config/Global.php';
    
    try {
        $categoria = CategoriaController::carregarVazio();
        $categoriaLista = CategoriaController::listar();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idCategoria = filter_input(INPUT_POST, 'id_categoria');
        
        if($method === 'salvar'){
            $nomeCategoria = filter_input(INPUT_POST, 'nome_categoria');
            $assunto = filter_input(INPUT_POST, 'assunto');
            
            CategoriaController::carregar($idCategoria, $nomeCategoria, $assunto);
            
        }elseif($method === 'editar'){
            $categoria = CategoriaController::buscaPorId($idCategoria);
        } elseif ($method === 'excluir') {
            CategoriaController::excluir($idCategoria);
        } 


    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }
    Template::header();
    // Para que os menus fiquem responsivos, é necessário que 
    // o sidebar() venha antes do navbar()
    Template::sidebar();
    Template::navbar();
    ?>

<!-- Inicio da Edição -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Categoria</h3>
                    </div>
                    <div class="content">
                        <form action="categorias.php" method="post">
                            <input type="hidden" name="metodo" value="salvar">
                            <input type="hidden" name="id_categoria" value="<?php echo $categoria->getIdCategoria() ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="nome_categoria" 
                                               value="<?php echo $categoria->getNomeCategoria() ?>" 
                                               class="form-control" autofocus required placeholder="Cadastro">
                                    </div>                
                                </div>                
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        <input type="text" name="assunto" value="<?php echo $categoria->getAssunto() ?>" 
                                               class="form-control" required placeholder="Assunto">
                                    </div>      
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block active" value="Salvar">
                                        </div>                
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inicio da Listagem -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Lista de Categorias</h3>
                    </div>
                    <?php CategoriaController::tabelaPaginada() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
