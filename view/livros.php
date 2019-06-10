<?php
    
require_once '../config/Global.php';
    
Template::header();

    try {
        $livro = LivroController::carregarVazio();
        $categoriaLista = CategoriaController::listar();
        $editoraLista = EditoraController::listar();
        $autorLista = AutorController::listar();
        $livroAutorLista = LivroAutorController::listar();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idLivro = filter_input(INPUT_POST, 'id_livro');
        
        if($method === 'salvar'){
            $titulo = filter_input(INPUT_POST, 'titulo');
            $isbn = filter_input(INPUT_POST, 'isbn');
            $edicao = filter_input(INPUT_POST, 'edicao');
            $editora = filter_input(INPUT_POST, 'editora');
            $ano = filter_input(INPUT_POST, 'ano');
            $categoria = filter_input(INPUT_POST, 'categoria');
            $imagem = filter_input(INPUT_POST, 'imagem');
            $descricao = filter_input(INPUT_POST, 'descricao');
            $autor = $_POST['autor'];
    
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
            $categoria, $editora, $descricao, $autor);
            
        }elseif($method === 'editar'){
            $livro = LivroController::buscaPorId($idLivro);
        } elseif ($method === 'excluir') {
            LivroController::excluir($idLivro);
        } 


    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }
    // Para que os menus fiquem responsivos, é necessário que 
    // o sidebar() venha antes do navbar()
    Template::sidebar();
    Template::navbar();
    ?>

<!-- Inicio da Edição -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Livro</h3>
                    </div>
                    <div class="content">
                        <form action="livros.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="metodo" value="salvar">
                            <input type="hidden" name="id_livro" value="<?php echo $livro->getIdLivro() ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="titulo" 
                                               value="<?php echo $livro->getTitulo() ?>" 
                                               class="form-control" autofocus required placeholder="Título do Livro">
                                    </div>                
                                </div>                
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <input type="text" name="isbn" value="<?php echo $livro->getIsbn() ?>" 
                                               class="form-control" required placeholder="ISBN">
                                    </div> 
                                    <div class="col-md-4">
                                        <input type="text" name="edicao" value="<?php echo $livro->getEdicao() ?>" 
                                               class="form-control" required placeholder="Edição">
                                    </div> 
                                    <div class="col-md-3">
                                        <input type="text" name="ano" value="<?php echo $livro->getAno() ?>" 
                                               class="form-control" required placeholder="Ano">
                                    </div> 
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="categoria">Categoria</label>
                                        <select class="form-control" name="categoria">
                                            <?php
                                                $selectedCat = '';
                                                foreach ($categoriaLista as $linha){
                                                    if($linha['id_categoria'] == $livro->getCategoria()){
                                                        $selectedCat = 'selected';
                                                    }
                                                ?>
                                            <option <?php echo $selectedCat ?> value="<?php echo $linha['id_categoria'] ?>"><?php echo $linha['nome_categoria'] ?></option>
                                            <?php
                                                    $selectedCat = '';
                                                }
                                            ?>
                                        </select> 
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="editora">Editora</label>
                                        <select class="form-control" name="editora">
                                            <?php
                                                $selectedEd = '';
                                                foreach ($editoraLista as $linhaEd){
                                                    if($linhaEd['id_editora'] == $livro->getEditora()){
                                                        $selectedEd = 'selected';
                                                    }
                                                ?>
                                            <option <?php echo $selectedEd ?> value="<?php echo $linhaEd['id_editora'] ?>"><?php echo $linhaEd['nome_editora'] ?></option>
                                            <?php
                                                    $selectedEd = '';
                                                }
                                            ?>
                                        </select> 
                                    </div> 
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="editora">Imagem</label>
                                        <input type="hidden" name="imagem" value="<?php echo $livro->getImagem() ?>">
                                        <input type="file" name="imagem" class="form-control btn-block">
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="autor">Autor(es)</label>
                                        <label name="autores" rows="3" cols="40" class="form-control"><?php 
                                            foreach ($livroAutorLista as $linhaLivAut){
                                                     if($linhaLivAut['livro'] == $livro->getIdLivro()){
                                                        foreach ($autorLista as $linhaAut){
                                                            if($linhaAut['id_autor'] == $linhaLivAut['autor']){
                                                                echo $linhaAut['nome_autor'] . ', ';
                                                            }
                                                         }
                                                    }
                                                }
                                            ?>
                                        </label>
                                        <select multiple name="autor[]" class="form-control">
                                            <?php
                                                foreach ($autorLista as $linhaAut){
                                                    ?>
                                                        <option value="<?php echo $linhaAut['id_autor'] ?>"><?php echo $linhaAut['nome_autor'] ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select> 
                                    </div> 
                                    
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="descricao">Descrição</label>
                                        <textarea name="descricao" rows="5" cols="40" class="form-control"><?php echo $livro->getDescricao() ?></textarea>
                                    </div> 
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-9">
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block active" value="Salvar">
                                        </div>                
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-user">
                    <div class="card">
                        <img class='card-img-top img-responsive' 
                             src="../assets/img/books/<?php echo $livro->getImagem() ?>" alt="..."/>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

<!-- Inicio da Listagem -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Lista de Livros</h3>
                    </div>
                    <?php LivroController::tabelaPaginada() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
