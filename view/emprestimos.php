<?php

require_once '../config/Global.php';

Template::header();
    
    try {
        
        $livroLista = LivroController::listar();
        $usuarioLista = UsuarioController::listar();
        $exemplarLista = EmprestimoController::listarExemplarLivro();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idEmprestimo = filter_input(INPUT_POST, 'id_emp_exmp');
        $idExemplar = filter_input(INPUT_POST, 'exemplar');
        $idUsuario = filter_input(INPUT_POST, 'id_usuario');
        
        // Método que excluir um emprestimo antes de ser salva no banco 
        function limparEmprestimo(){
            unset($emprestimoLista);
            unset($_SESSION['emprestimo_idEmpExemp']);
            unset($_SESSION['emprestimo_exemplar']);
            $emprestimoLista = array();
            $_SESSION['emprestimo_idEmpExemp'] = array();
            $_SESSION['emprestimo_exemplar'] = array();
        }
        
        
        if($method == 'filtrar'){
            foreach ($usuarioLista as $user){
                if($user['id_usuario'] === $idUsuario){
                    $_SESSION['usuario_pesquisa'] = $user['nome_usuario'];
                    $_SESSION['usuario_pesquisa_id'] = $user['id_usuario'];
                }
            }
            $reservaLista = EmprestimoController::listarReservas($idUsuario);
            $emprestimoLista = array();
            limparEmprestimo();
                    
        }elseif ($method == 'selecionar') {
            if($idEmprestimo > 0  && $idExemplar > 0){
                array_push($_SESSION['emprestimo_idEmpExemp'], $idEmprestimo);
                array_push($_SESSION['emprestimo_exemplar'], $idExemplar);
                $emprestimoLista = array_combine($_SESSION['emprestimo_idEmpExemp'], $_SESSION['emprestimo_exemplar']);
                $reservaLista = EmprestimoController::listarReservas($idUsuario);
            }             
        }elseif($method == 'emprestar') {
            if(count($_SESSION['emprestimo_idEmpExemp']) > 0 && count($_SESSION['emprestimo_exemplar']) > 0){                
                $emprestimoLista = array_combine($_SESSION['emprestimo_idEmpExemp'], $_SESSION['emprestimo_exemplar']);
                EmprestimoController::emprestar($emprestimoLista);
            }
        }elseif($method == 'limpar') {
            $reservaLista = array();
            $emprestimoLista = array();
            limparEmprestimo();
        }elseif ($method == 'devolver') {
            if(EmprestimoController::devolver($idEmprestimo, $idExemplar)){
                $emprestimoLista = array_combine($_SESSION['emprestimo_idEmpExemp'], $_SESSION['emprestimo_exemplar']);
                $reservaLista = EmprestimoController::listarReservas($idUsuario);
            }
        }else {
                $emprestimoLista = array();
                $reservaLista = array();
                $_SESSION['usuario_pesquisa'] = "Selecione um Usuário";
                $_SESSION['usuario_pesquisa_id'] = 0;
        }
        
        $usuarioNome = $_SESSION['usuario_pesquisa'];
        
        
        
        
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
            <div class="col-md-12 card">
                <div class="header">
                    <h3 class='title'><?php echo $usuarioNome ?></h3>
                    <!-- Seleciona o Usuário a ser pesquisado -->
                    <form name="selecUsuario" action="emprestimos.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-1">
                                <select class="form-control" name="id_usuario">
                                    <option> Selecione um Usuário... </option>
                                    <?php
                                    foreach ($usuarioLista as $user){
                                        if($user['grupo'] == 1){
                                            ?>
                                            <option value="<?php echo $user['id_usuario'] ?>">
                                                <?php echo $user['nome_usuario'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                        ?>
                                </select>
                            </div>
                            <div class='col-md-2'>
                                <button type='submit' name='metodo' value='filtrar' 
                                        class='btn btn-block btn-info active'>Filtro</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
                
                <div class="col-md-10 col-md-offset-1">
                    <div class="card-body">
                        <div class="header">
                            <h3 class="title">Emprestar</h3>
                        </div>
                        <form name="emprestar" action='emprestimos.php' method='POST'>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                        foreach ($emprestimoLista as $idEmprestimo => $idExemp){
                                            foreach ($exemplarLista as $el){
                                                if($el['id_exemplar'] == $idExemp){
                                                    ?> 
                                                        <div class="col-lg-2">
                                                            <img class='card-img-top' 
                                                                 src='../assets/img/books/<?php echo $el['imagem'] ?>' 
                                                                 style="width: 75px; height: 95px;" />
                                                    <?php
                                                        echo $idExemp; ?> 
                                                        </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3 col-md-offset-5">
                                        <div class="form-group">
                                            <button type='submit' name='metodo' value='limpar' 
                                                    class='btn btn-block btn-danger active'>Limpar</button>
                                        </div>                
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type='submit' name='metodo' value='emprestar' 
                                                    class='btn btn-block btn-success active'>Emprestar</button>
                                        </div>                
                                    </div> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="header">
                            <h3 class="title">Reservas</h3>
                        </div>
                        <div class='content table-responsive table-full-width'>
                            <table class='table table-hover table-striped'>
                                <thead>
                                    <th>Livro</th>
                                    <th></th>
                                    <th>Exemplares</th>
                                </thead>
                                <?php 
                                foreach ($reservaLista as $reserva){ //Todas as reservas desse usuario
                                    if($reserva['data_emprestimo'] === NULL){
                                        foreach($livroLista as $linha){ // todas as informações do livro reservado
                                            if($linha['id_livro'] == $reserva['livro']){ // combinando os livros reserados com a lista de livros
                                                $idLivro = $reserva['livro'];
                                                $idEmpExemp = $reserva['id_emprestimo_exemplar'];
                                                $nomeLivro = $linha['titulo'];
                                                $imagem = $linha['imagem'];
                                ?>
                                <tbody>
                                    <tr>
                                        <td> 
                                            <div class="card-img-top" style="width: 45px; height: 60px">
                                                <img class='card-img-top' 
                                                     src='../assets/img/books/<?php echo $imagem ?>' 
                                                     style="width: 100%; height: 100%;" />
                                            </div>
                                        </td>
                                        <td><?php echo $nomeLivro ?></td>
                                        <td><?php  
                                            foreach ($exemplarLista as $exemp){
                                                if($exemp['livro'] == $idLivro && $exemp['emprestado'] == 0){
                                                    $exemplar = $exemp['id_exemplar'];
                                                    ?>
                                                    <form action='emprestimos.php' method='POST'>
                                                        <input type='hidden' name='id_usuario' value='<?php echo $idUsuario ?>'>
                                                        <input type='hidden' name='id_emp_exmp' value='<?php echo $idEmpExemp ?>'>
                                                        <input type='hidden' name='metodo' value='selecionar'/>
                                                        <button type="submit" name="exemplar" value="<?php echo $exemplar ?>"
                                                                class='btn btn-block btn-primary active'><?php echo $exemplar ?></button>
                                                    </form>
                                                    <?php
                                                }
                                            }

                                        ?>

                                        </td>
                                    </tr>
                                </tbody>

                                <?php

                                            }
                                        }
                                    }
                                } 
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="header">
                            <h3 class="title">Emprestimos</h3>
                        </div>
                        <div class='content table-responsive table-full-width'>
                            <table class='table table-hover table-striped'>
                                <thead>
                                    <th>Livro</th>
                                    <th></th>
                                    <th>Exemplar</th>
                                    <th class='acao'>Devolver</th>
                                </thead>
                                <?php 
                                foreach ($reservaLista as $reserva){ //Todas as reservas desse usuario
                                    if($reserva['data_devolucao'] == NULL && $reserva['data_emprestimo'] != NULL){
                                        foreach($livroLista as $linha){ // todas as informações do livro reservado
                                            if($linha['id_livro'] == $reserva['livro']){ // combinando os livros reserados com a lista de livros
                                                $idLivro = $reserva['livro'];
                                                $idEmpExemp = $reserva['id_emprestimo_exemplar'];
                                                $nomeLivro = $linha['titulo'];
                                                $imagem = $linha['imagem'];
                                                $exemplar = $reserva['exemplar']
                                ?>
                                <tbody>
                                    <tr>
                                        <td> 
                                            <div class="card-img-top" style="width: 45px; height: 60px">
                                                <img class='card-img-top' 
                                                     src='../assets/img/books/<?php echo $imagem ?>' 
                                                     style="width: 100%; height: 100%;" />
                                            </div>
                                        </td>
                                        <td><?php echo $nomeLivro ?></td>
                                        <td><?php echo $exemplar ?></td>
                                        <td>
                                            <form action='emprestimos.php' method='POST'>
                                                <input type='hidden' name='id_usuario' value='<?php echo $idUsuario ?>'>
                                                <input type='hidden' name='id_emp_exmp' value='<?php echo $idEmpExemp ?>'>
                                                <input type="hidden" name="exemplar" value="<?php echo $exemplar ?>"/>
                                                <button type="submit" name="metodo" value="devolver"
                                                        class='btn btn-info active pe-7s-back'></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>

                                <?php
                                            }
                                        }
                                    }
                                } 
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>
    </div>
</div>
<?php
    Template::footer();
