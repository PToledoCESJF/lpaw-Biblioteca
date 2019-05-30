<?php
    
require_once '../config/Global.php';
    
    try {
        $idLivro = filter_input(INPUT_GET, 'id_livro');
        $livro = LivroController::buscaPorId($idLivro);
        
        $categoriaLista = CategoriaController::listar();
        $editoraLista = EditoraController::listar();
        
        $method = filter_input(INPUT_POST, 'metodo');
        
        if($method === 'salvar'){
            $isbn = filter_input(INPUT_POST, 'isbn');
            $edicao = filter_input(INPUT_POST, 'edicao');
            $editora = filter_input(INPUT_POST, 'editora');
            $ano = filter_input(INPUT_POST, 'ano');
            $categoria = filter_input(INPUT_POST, 'categoria');
            $imagem = filter_input(INPUT_POST, 'imagem');
            $descricao = filter_input(INPUT_POST, 'descricao');

            if($imagem == NULL || $imagem != $livro->getImagem()){ 
                $imagensPermitidas = array("png", "jpeg", "jpg", "gif");
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                if(in_array($extensao, $imagensPermitidas)){
                    $pasta = '../assets/img/books/';
                    $temporario = $_FILES['imagem']['tmp_name'];
                    $imagem = uniqid() . '.' . $extensao;

                    move_uploaded_file($temporario, $pasta . $imagem);
                }
            }

            LivroController::carregar($idLivro, $titulo, $isbn, $edicao, $ano, $imagem, 
            $categoria, $editora, $descricao);
            
        }elseif($method === 'editar'){
            $livro = LivroController::buscaPorId($idLivro);
        } elseif ($method === 'excluir') {
            LivroController::excluir($idLivro);
        } 


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
                                            <p class='card-text'><strong>Editora:</strong> <?php echo $livro->getEditora()?></p>
                                            <p class='card-text'><strong>Ano:</strong> <?php echo $livro->getAno()?></p>
                                            <p class='card-text'><strong>Autor(es):</strong> </p>
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
                                    <div class='card-title'>
                                        <h5 class="text-muted"><strong>Reservas</strong></h5>
                                    </div>
                                    <div class="content">
                                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                        <div class="footer">
                                            <div class="legend">
                                                <i class="fa fa-circle text-info"></i> Março
                                                <i class="fa fa-circle text-danger"></i> Abril
                                                <i class="fa fa-circle text-warning"></i> Maio
                                            </div>
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-clock-o"></i> Dados dos últimos 3 meses
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <input type="submit" value="Reservar" name="reservar" />
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
