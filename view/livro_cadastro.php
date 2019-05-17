<?php
    
require_once '../config/Global.php';
    
    try {
        $livro = LivroController::carregarVazio();
        $categoriaLista = CategoriaController::listar();
        $editoraLista = EditoraController::listar();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idLivro = filter_input(INPUT_POST, 'id_livro');
        
        if($method === 'salvar'){
            $titulo = filter_input(INPUT_POST, 'titulo');
            $isbn = filter_input(INPUT_POST, 'isbn');
            $edicao = filter_input(INPUT_POST, 'edicao');
            $editora = filter_input(INPUT_POST, 'editora');
            $ano = filter_input(INPUT_POST, 'ano');
            $categoria = filter_input(INPUT_POST, 'categoria');
            $upload = filter_input(INPUT_POST, 'upload');
            
            $imagensPermitidas = array("png", "jpeg", "jpg", "gif");
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            if(in_array($extensao, $imagensPermitidas)){
                $pasta = '../assets/img/books/';
                $temporario = $_FILES['imagem']['tmp_name'];
                $imagem = uniqid() . '.' . $extensao;
                
                if(move_uploaded_file($temporario, $pasta . $imagem)){
                        $msg = 'Upload feito com sucesso!';
                }else{
                    $msg = 'Erro, não foi possível fazer o upload';
                }
            }else{
                $msg = 'Formato inválido';
            }

            echo $msg;

            LivroController::carregar($idLivro, $titulo, $isbn, $edicao, 
                    $editora, $ano, $categoria, $imagem, $upload);
            
        }elseif($method === 'editar'){
            $livro = LivroController::buscaPorId($idLivro);
        } elseif ($method === 'excluir') {
            LivroController::excluir($idLivro);
        } 


    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }
    Template::header();
    Template::navbar();
    Template::sidebar();
    ?>

<!-- Inicio da Edição -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Livro</h3>
                    </div>
                    <div class="content">
                        <form action="livro.php" method="POST" enctype="multipart/form-data">
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
                                                    $selected = '';
                                                }
                                            ?>
                                        </select> 
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="editora">Editora</label>
                                        <select class="form-control" name="editora">
                                            <?php
                                                $selectedEd = '';
                                                foreach ($editoraLista as $linha){
                                                    if($linha['id_editora'] == $livro->getEditora()){
                                                        $selectedEd = 'selected';
                                                    }
                                                ?>
                                            <option <?php echo $selectedEd ?> value="<?php echo $linha['id_editora'] ?>"><?php echo $linha['nome_editora'] ?></option>
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
                                        <input type="file" name="imagem" value="<?php echo $livro->getImagem() ?>" 
                                               class="form-control btn-block">
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="editora">Livro Digital</label>
                                        <input type="file" name="upload" value="<?php echo $livro->getUpload() ?>" 
                                               class="form-control btn-block">
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
