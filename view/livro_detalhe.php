<?php

require_once '../config/Global.php';

Template::header();
    
    try {
        
        $method = filter_input(INPUT_POST, 'metodo');
        
        if($method == 'reservar'){
            if($_SESSION['usuario_grupo'] == 0){
                header('Location: ../view/login.php');           
            } else {
                header('Location: ../view/livro_reserva.php');
            }
        }
        

        
        $livro = LivroController::buscaPorId($_SESSION['livro_id']);
        $categoriaLista = CategoriaController::listar();
        $editoraLista = EditoraController::listar();
        $livroAutorLista = LivroAutorController::listar();
        $autorLista = AutorController::listar();
        
        $autores = [];
        $nomesAutores = [];
        
        foreach ($editoraLista as $ed){
            if($livro->getEditora() == $ed['id_editora']){
                $editora = $ed['nome_editora'];
            }
        }
        
        foreach ($livroAutorLista as $la){
            if($livro->getIdLivro() == $la['livro']){
                array_push($autores, $la['autor']);
            }
        }
        
        foreach ($autores as $idAuts){
            foreach ($autorLista as $al){
                if($idAuts == $al['id_autor']){
                    array_push($nomesAutores, $al['nome_autor']);
                }
                    
            }
        }
        
    
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
            <div class='col-md-12'  style="align-content: center">
                <h3 class='card-title text-muted'><strong><?php echo $livro->getTitulo() . " - " . $livro->getEdicao() ?></strong></h3>
                <div class='card'>
                    <div class="row">
                        <div class='col-lg-3'>
                            <div class='card'>
                                <img class='card-img-top img-responsive' 
                                     src="../assets/img/books/<?php echo $livro->getImagem() ?>" alt="..."
                                     style="padding: 5px"/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="row">
                                <div class='col-lg-12'>
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h5 class='card-subtitle text-info'><strong><?php echo $livro->getTitulo()?></strong></h5>
                                            <p class='card-text'><strong>Edição:</strong> <?php echo $livro->getEdicao()?></p>                                            
                                            <p class='card-text'><strong>Editora:</strong> <?php echo $editora ?></p>
                                            <p class='card-text'><strong>Ano:</strong> <?php echo $livro->getAno()?></p>
                                            <p class='card-text'><strong>Autor(es):</strong>
                                                <?php foreach ($nomesAutores as $nomes){
                                                    echo $nomes . ', ';
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-lg-12'>
                                    <div class='card'>
                                        <div class='card-body'>
                                            <label class="form-control">Descrição</label>
                                            <p class='card-text text-muted'><?php echo $livro->getDescricao()?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='card'>
                                <div class='card-body'>
                                    <form action="livro_detalhe.php" method="POST">
                                        <div class='card-title'>
                                            <h5 class="text-muted"><strong>Reservas</strong></h5>
                                        </div>
                                        <div class="content">
                                            <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                            <div class="footer">
                                                <hr>
                                                <input type="submit" class="btn btn-primary btn-block active" 
                                                        name="metodo"  value="reservar">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
