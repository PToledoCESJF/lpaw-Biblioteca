<?php 

require_once '../config/Global.php';
Template::header();

    try {
        
        $livroLista = LivroController::listar();
        
        if(filter_input(INPUT_GET, 'cl') === 'y'){
            session_destroy();
        }
            
        
    //    $categoriaLista = CategoriaController::listar();
    //    $editoraLista = EditoraController::listar();
    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }

    // Para que os menus fiquem responsivos, é necessário que 
    // o sidebar() venha antes do navbar()
    Template::sidebar();
    Template::navbar();

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Olá, <strong><?php echo $_SESSION['usuario_nome'] ?>!</strong> Seja bem-vindo ao Bibliotecasa</h3>
                
                <div class="card">
                    <?php foreach ($livroLista as $linha): ?>
                            <div class="col-lg-2" style="width: 200px; height: 235px">
                                <a href='livro_detalhe.php?id_livro=<?php echo $linha['id_livro'] ?>'>
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
