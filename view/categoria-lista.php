<?php
require_once '../config/Global.php';
try {
    $categoriaLista = CategoriaController::listar();
} catch (Exception $exc) {
    Erro::trataErro($exc);
}
require_once './cabecalho.php';
?>
<div class="row">
    <div class="col-md-12">
        <h2>Categorias</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <a href="./categoria-novo.php" class="btn btn-info btn-block">Nova Categoria</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php if(count($categoriaLista) > 0): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Assunto</th>
                    <th class="acao">Editar</th>
                    <th class="acao">Excluir</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($categoriaLista as $linha): ?>
                    <tr>
                        <td><?php echo $linha['id_categoria'] ?></td>
                        <td><?php echo $linha['nome_categoria'] ?></td>
                        <td><?php echo $linha['descricao'] ?></td>
                        <td><?php echo $linha['assunto'] ?></td>
                        <td><a href="./categoria-editar.php?id=<?php echo $linha['id_categoria'] ?>" class="btn btn-info">Editar</a></td>
                        <td><a href="./categoria-excluir.php?id=<?php echo $linha['id_categoria'] ?>" class="btn btn-danger">Excluir</a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma Categoria cadastrada!</p>
        <?php endif ?>
    </div>
</div>