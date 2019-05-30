<?php
    
require_once '../config/Global.php';
    
    try {
        $exemplar = ExemplarController::carregarVazio();
        $livroLista = LivroController::listar();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idExemplar = filter_input(INPUT_POST, 'id_exemplar');
        
        if($method === 'salvar'){
            $livro = filter_input(INPUT_POST, 'livro');
            $tipoExemplar = filter_input(INPUT_POST, 'tipo_exemplar');
            
             if($idExemplar == NULL){ 
                $tiposPermitidos = array("pdf", "doc", "docx", "odt", "txt");
                $extensao = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
                if(in_array($extensao, $tiposPermitidos)){
                    $pasta = '../assets/books/';
                    $temporario = $_FILES['upload']['tmp_name'];
                    $idExemplar = uniqid() . '.' . $extensao;

                    move_uploaded_file($temporario, $pasta . $idExemplar);
                }
            }
            
            ExemplarController::carregar($idExemplar, $livro, $tipoExemplar);
        }elseif($method === 'editar'){
            $exemplar = ExemplarController::buscaPorId($idExemplar);
        } elseif ($method === 'excluir') {
            ExemplarController::excluir($idExemplar);
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

<!-- Inicio da Edição -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Exemplar</h3>
                    </div>
                    <div class="content">
                        <form action="exemplar.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="metodo" value="salvar">
                            <input type="hidden" name="id_exemplar" value="<?php echo $exemplar->getIdExemplar() ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="livro">Livro</label>
                                            <select class="form-control" name="livro">
                                                <?php
                                                    $selected = '';
                                                    foreach ($livroLista as $linha){
                                                        if($linha['id_livro'] == $exemplar->getLivro()){
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                <option <?php echo $selected ?> value="<?php echo $linha['id_livro'] ?>"><?php echo $linha['titulo'] ?></option>
                                                <?php
                                                        $selected = '';
                                                    }
                                                ?>

                                            </select> 
                                        </div>
                                            <div class="col-md-6">
                                                <label for="tipo_exemplar">Tipo de Exemplar</label>
                                                <input type="text" name="tipo_exemplar" 
                                                       value="<?php echo $exemplar->getTipoExemplar() ?>" 
                                                       class="form-control" required placeholder="Tipo de Exemplar">
                                            </div>      
                                    </div>
                                </div>                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <input type="file" name="upload" class="form-control btn-block">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-block active" value="Salvar">
                                            </div>                
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


<!-- Inicio da Listagem -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title">Lista de Exemplares</h3>
                    </div>
                    <?php ExemplarController::tabelaPaginada() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
