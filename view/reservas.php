<?php

require_once '../config/Global.php';

Template::header();
    
    try {
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idEmpExemp = filter_input(INPUT_POST, 'id_emp_exmp');
        $visualizacao = filter_input(INPUT_GET, 'w3wb');
        $livroLista = LivroController::listar();
        $usuarioLista = UsuarioController::listar();
        $hoje = date('d-m-Y');
        
        
        if ($method == 'excluir') {
            EmprestimoController::excluirReserva($idEmpExemp);
        } 
        
        $usuarioNome = 'Selecione um Usuário';
        
        if($visualizacao == 'ds1fa5d4f53'){
            $usuarioNome = $_SESSION['usuario_nome'];
            $idUsuario = $_SESSION['usuario_id'];
        }elseif ($visualizacao == 'ed12f8h423h') {
            $usuarioNome = $_SESSION['usuario_pesquisa'];
            $idUsuario = $_SESSION['usuario_pesquisa_id'];
        }else {
            $idUsuario = filter_input(INPUT_POST, 'id_usuario');
            if($method == 'filtrar'){
                foreach ($usuarioLista as $user){
                    if($user['id_usuario'] === $idUsuario){
                        $usuarioNome = $user['nome_usuario'];
                        $_SESSION['usuario_pesquisa'] = $user['nome_usuario'];
                        $_SESSION['usuario_pesquisa_id'] = $user['id_usuario'];
                    }
                }
            }
        }

        $reservaLista = EmprestimoController::listarReservas($idUsuario);
        

        function headerPesquisa($visualizacao, $usuarioLista){
            if($visualizacao !== 'ds1fa5d4f53'){
                echo "
                    <form action='reservas.php' method='POST'>
                        <div class='row'>
                            <div class='col-md-4'>
                                <select class='form-control' name='id_usuario'>
                                    <option>Selecione um Usuário...</option>";
                                    foreach ($usuarioLista as $user){
                                        ?>
                                        <option value="<?php echo $user['id_usuario'] ?>">
                                            <?php echo $user['nome_usuario'] ?>
                                        </option>
                                        <?php
                                    }
                echo "
                                </select>
                            </div>
                            <div class='col-md-2'>
                                <button type='submit' class='btn btn-block btn-info active'
                                        name='metodo' value='filtrar' >Filtro</button>
                            </div>
                        </div>
                    </form>";
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
            <div class="col-md-12 card">
                <div class="header">
                    <h3 class='title'><?php echo $usuarioNome ?></h3>
                    <?php headerPesquisa($visualizacao, $usuarioLista);?>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h3 class="title">Reservas</h3>
                        </div>
                        
                        <div class='content table-responsive table-full-width'>
                            <table class='table table-hover table-striped'>
                                <thead>
                                    <th>Livro</th>
                                    <th></th>
                                    <th class='acao'>Excluir</th>
                                </thead>
                                <?php 
                                $nomeLivro = "";
                                foreach ($reservaLista as $reserva){
                                    if($reserva['data_emprestimo'] === NULL){
                                        foreach($livroLista as $linha){
                                            if($linha['id_livro'] == $reserva['livro']){
                                                $idEmpExemp = $reserva['id_emprestimo_exemplar'];
                                                $nomeLivro = $linha['titulo'];
                                                $imagem = $linha['imagem'];
                                            }
                                        }
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
                                        <td>
                                            <form action='reservas.php' method='POST'>
                                                <input type='hidden' name='id_emp_exmp' value='<?php echo $idEmpExemp ?>'>
                                                <button type='submit' name='metodo' value='excluir' 
                                                        class='btn btn-danger active pe-7s-trash'></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php 
                                    }
                                } ?>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h3 class="title">Emprestimos</h3>
                        </div>
                        
                        <div class='content table-responsive table-full-width'>
                            <table class='table table-hover table-striped'>
                                <thead>
                                    <th>Livro</th>
                                    <th>Exemplar</th>
                                    <th>Prev. Devolução</th>
                                    <th>Status</th>
                                </thead>
                                <?php 
                                foreach ($reservaLista as $reserva){
                                    $dtEmprestimo = $reserva['data_emprestimo'];
                                    if($dtEmprestimo !== NULL){
                                        foreach($livroLista as $linha){
                                            if($linha['id_livro'] == $reserva['livro']){
                                                $idEmpExemp = $reserva['id_emprestimo_exemplar'];
                                                $imagem = $linha['imagem'];
                                                $exemplar = $reserva['exemplar'];
                                                $previsaoDev = date('d/m/Y', strtotime('+' . PRAZO  . ' days'));
                                                $dtDevolucao = $reserva['data_devolucao'];
                                                if($dtDevolucao !== NULL){
                                                    $msg = 'Devolvido';
                                                    $cor = 'success';
                                                }else{
                                                    if ($previsaoDev >= $hoje) {
                                                        $msg = 'No Prazo';
                                                        $cor = 'primary';
                                                    } else {
                                                        $msg = 'Vencido';
                                                        $cor = 'danger';
                                                    }
                                                }
                                                $status =  "<label class='text-$cor'><strong>$msg</strong></label>";
                                            }
                                        }
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
                                        <td><?php echo $exemplar ?></td>
                                        <td><?php echo $previsaoDev ?></td>
                                        <td><?php echo $status ?></td>
                                    </tr>
                                </tbody>
                                <?php }
                                }?>
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
