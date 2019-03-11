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
        <h3>Confirma a exclusão do assunto?</h3>
    </div>
</div>
<form action="../controller/assunto.php" method="post">
    <input type="hidden" name="metodo" value="excluir">
    <input type="hidden" name="id_assunto" value="<?php echo $assunto->getId_assunto() ?>">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <h2><?php echo $assunto->getAssunto() ?></h2>
                </div>                
                <input type="submit" class="btn btn-success btn-block" value="Voltar" formaction="./assunto-lista.php">
                <input type="submit" class="btn btn-danger btn-block" value="Excluir">
            </div>
        </div>
    </form>
<?php require_once 'rodape.php' ?>
