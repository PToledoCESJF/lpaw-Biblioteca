<?php

require_once '../config/Global.php';
try {
    $assuntoController = new AssuntoController();
    $id = filter_input(INPUT_GET, 'id');
    $assunto = $assuntoController->buscaPorId($id);
} catch (Exception $exc) {
    Erro::trataErro($exc);
}
require_once './cabecalho.php';
?>
<div class="row">
    <div class="col-md-12">
        <h2>Atualizar assunto</h2>
    </div>
</div>
<form action="../controller/assunto.php" method="post">
    <input type="hidden" name="metodo" value="atualizar">
    <input type="hidden" name="id_assunto" value="<?php echo $assunto->getId_assunto() ?>">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="assunto">Assunto</label>
                <input type="text" name="assunto" class="form-control" value="<?php echo $assunto->getAssunto() ?>">
            </div>                
            <input type="submit" class="btn btn-success btn-block" value="Salvar">
        </div>
    </div>
</form>
<?php // include './convenio-form-base.php'; ?>

<?php require_once './rodape.php' ?>


