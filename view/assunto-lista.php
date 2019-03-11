<?php
require_once '../config/Global.php';
try {
    $assunto = new AssuntoController();
    $assuntoLista = $assunto->listar();
} catch (Exception $exc) {
    Erro::trataErro($exc);
}
require_once './cabecalho.php';
?>
<div class="row">
    <div class="col-md-12">
        <h2>Assuntos</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <a href="./assunto-novo.php" class="btn btn-info btn-block">Novo Assunto</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php if(count($assuntoLista) > 0): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Ordem</th>
                    <th>Assunto</th>
                    <th class="acao">Editar</th>
                    <th class="acao">Excluir</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($assuntoLista as $linha): ?>
                    <tr>
                        <td><?php echo $linha['id_assunto'] ?></td>
                        <td><?php echo $linha['assunto'] ?></td>
                        <td><a href="./assunto-editar.php?id=<?php echo $linha['id_assunto'] ?>" class="btn btn-info">Editar</a></td>
                        <td><a href="./assunto-excluir.php?id=<?php echo $linha['id_assunto'] ?>" class="btn btn-danger">Excluir</a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum assunto cadastrado!</p>
        <?php endif ?>
    </div>
</div>