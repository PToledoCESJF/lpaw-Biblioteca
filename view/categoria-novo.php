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
        <h2>Nova Categoria</h2>
    </div>
</div>
<form action="../controller/sCategoria.php" method="post">
    <input type="hidden" name="metodo" value="inserir">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="nome_categoria">Categoria</label>
                <input type="text" name="nome_categoria" class="form-control" autofocus required>
            </div>                
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" class="form-control" required>
            </div>                
            <div class="form-group">
                <label for="assunto">Assunto</label>
                <input type="text" name="assunto" class="form-control" required>
            </div>                
            <input type="submit" class="btn btn-success btn-block" value="Salvar">
        </div>
    </div>
</form>

<?php require_once './rodape.php' ?>

