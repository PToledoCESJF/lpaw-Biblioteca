<?php
    
require_once '../config/Global.php';
    
    try {
        $autor = AutorController::carregarVazio();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idAutor = filter_input(INPUT_POST, 'id_autor');
        
        if($method === 'salvar'){
            $nomeAutor = filter_input(INPUT_POST, 'nome_autor');
            AutorController::carregar($idAutor, $nomeAutor);
        }elseif($method === 'editar'){
            $autor = AutorController::buscaPorId($idAutor);
        } elseif ($method === 'excluir') {
            AutorController::excluir($idAutor);
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
                        <h3 class="title">Autor</h3>
                    </div>
                    <div class="content">
                        <form action="autor.php" method="post">
                            <input type="hidden" name="metodo" value="salvar">
                            <input type="hidden" name="id_autor" value="<?php echo $autor->getIdAutor() ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="nome_autor" 
                                               value="<?php echo $autor->getNomeAutor() ?>" 
                                               class="form-control" autofocus required placeholder="Nome do Autor">
                                    </div>                
                                </div>                
                            </div>
                            <div class="row">
                                <div class="form-group">
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

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Lista de Autores</h3>
                    </div>
                    <?php AutorController::tabelaPaginada() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
