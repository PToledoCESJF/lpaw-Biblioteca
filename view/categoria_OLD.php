<?php
require_once '../config/Global.php';
try {
    $categoriaLista = CategoriaController::listar();
    $categoria = CategoriaController::buscaPorId(filter_input(INPUT_POST, 'id_categoria'));
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
            <!--
            <div class="col-md-4">
                <div class="container center-block">
                    <img src="../assets/img/navbar-1.png" class="img-responsive" >
                </div>
            </div>
            -->
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Categoria</h3>
                    </div>
                    <div class="content">
                        <form action="../controller/sCategoria.php" method="post">
                            <input type="hidden" name="metodo" value="salvar">
                            <input type="hidden" name="id_categoria" value="<?php echo $categoria->getIdCategoria() ?>">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" name="nome_categoria" 
                                               value="<?php echo $categoria->getNomeCategoria() ?>" 
                                               class="form-control" autofocus required placeholder="Cadastro">
                                    </div>                
                                </div>                
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" name="descricao" 
                                               value="<?php echo $categoria->getDescricao() ?>" 
                                               class="form-control" required placeholder="Descrição">
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
</div>

<!-- Inicio da Listagem -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Lista de Categorias</h3>
                    </div>
                    <?php if(count($categoriaLista) > 0): ?>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>id</th>
                                    <th>Categoria</th>
                                    <th>Descrição</th>
                                    <th>Assunto</th>
                                    <th class="acao">Editar</th>
                                    <th class="acao">Excluir</th>
                                </thead>
                                <tbody>
                                    <?php foreach($categoriaLista as $linha): ?>
                                    <tr>
                                        <td><?php echo $linha['id_categoria'] ?></td>
                                        <td><?php echo $linha['nome_categoria'] ?></td>
                                        <td><?php echo $linha['descricao'] ?></td>
                                        <td><?php echo $linha['assunto'] ?></td>
                                        <td>
                                            <form action="../view/categoria.php" method="POST">
                                                <input type="hidden" name="id_categoria" value="<?php echo $linha['id_categoria'] ?>">
                                                <button type="submit" class="btn btn-info active pe-7s-edit"></button>
                                            </form>
                                        </td>
                                        
                                        <td>
                                            <form action="../controller/sCategoria.php" method="POST">
                                                <input type="hidden" name="id_categoria" value="<?php echo $linha['id_categoria'] ?>">
                                                <input type="hidden" name="metodo" value="excluir">
                                                <button type="submit" class="btn btn-danger active pe-7s-trash"></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>Nenhuma Categoria cadastrada!</p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
