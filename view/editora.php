<?php
    
require_once '../config/Global.php';
    
    try {
        $editora = EditoraController::carregarVazio();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idEditora = filter_input(INPUT_POST, 'id_editora');
        
        if($method === 'salvar'){
            $nomeEditora = filter_input(INPUT_POST, 'nome_editora');
            EditoraController::carregar($idEditora, $nomeEditora);
        }elseif($method === 'editar'){
            $editora = EditoraController::buscaPorId($idEditora);
        } elseif ($method === 'excluir') {
            EditoraController::excluir($idEditora);
        } 


    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }
    Template::header();
    Template::navbar();
    Template::sidebar();
    ?>

<!-- Inicio da Edição -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Editora</h3>
                    </div>
                    <div class="content">
                        <form action="editora.php" method="post">
                            <input type="hidden" name="metodo" value="salvar">
                            <input type="hidden" name="id_editora" value="<?php echo $editora->getIdEditora() ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="nome_editora" 
                                               value="<?php echo $editora->getNomeEditora() ?>" 
                                               class="form-control" autofocus required placeholder="Nome do Editora">
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
</div>

<!-- Inicio da Listagem -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Lista de Editoraes</h3>
                    </div>
                    <?php EditoraController::tabelaPaginada() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
