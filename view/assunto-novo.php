<?php
require_once '../config/Global.php';
try {
    //$assunto = new AssuntoController();
} catch (Exception $exc) {
    Erro::trataErro($exc);
}
require_once './cabecalho.php';
?>
<div class="row">
    <div class="col-md-12">
        <h2>Novo assunto</h2>
    </div>
</div>
<form action="../controller/assunto.php" method="post">
    <input type="hidden" name="metodo" value="inserir">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="assunto">Assunto</label>
                <input type="text" name="assunto" class="form-control" autofocus required>
            </div>                
            <input type="submit" class="btn btn-success btn-block" value="Salvar">
        </div>
    </div>
</form>
<?php // include './convenio-form-base.php'; ?>

<?php require_once './rodape.php' ?>

