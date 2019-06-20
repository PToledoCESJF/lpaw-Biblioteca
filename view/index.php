<?php 

require_once '../config/Global.php';
Template::header();

    try {
        
        $livroLista = LivroController::listar();
        $method = filter_input(INPUT_POST, 'metodo');
        $idLivro = filter_input(INPUT_POST, 'id_livro');
        

        if($method == 'detalhar'){
            $_SESSION['livro_id'] = $idLivro;
            header('Location: ../view/livro_detalhe.php');
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
                <form action="index.php" method="POST">
                    <input type="hidden" name="metodo" value="detalhar">
                    <div class="card">
                        <?php foreach ($livroLista as $linha): ?>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn-link" name="id_livro" 
                                            value="<?php echo $linha['id_livro'] ?>" 
                                            style="width: 190px; height: 235px">
                                        <img class='card-img-top' 
                                             src='../assets/img/books/<?php echo $linha['imagem'] ?>' 
                                             style="width: 100%; height: 100%; padding: 5px;" />
                                    </button> 
                                    <p>Qualquer outra informação vai </p>
                                </div>
                        <?php endforeach; ?>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

</body>
<?php 
Template::footer();
?>
