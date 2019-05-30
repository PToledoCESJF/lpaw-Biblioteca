<?php 

require_once '../config/Global.php';

    try {
        $livroLista = LivroController::listar();
    //    $categoriaLista = CategoriaController::listar();
    //    $editoraLista = EditoraController::listar();
    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }

    Template::header();
    // Para que os menus fiquem responsivos, é necessário que 
    // o sidebar() venha antes do navbar()
    Template::sidebar();
    Template::navbar();

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Seja bem-vindo ao Sistema de Controle de Acervo</h2>
                
                <div class="card">
                    <?php foreach ($livroLista as $linha): ?>
                            <div class="col-lg-2" style="width: 200px; height: 235px">
                                <a href='livro_selecionado.php?id_livro=<?php echo $linha['id_livro'] ?>'>
                                    <img class='card-img-top' 
                                         src='../assets/img/books/<?php echo $linha['imagem'] ?>' 
                                         style="width: 100%; height: 100%; padding: 5px;" /></a>
                            </div>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
    </div>
</div>

</body>
<?php 
Template::footer();
?>
