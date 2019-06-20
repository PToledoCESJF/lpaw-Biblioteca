<?php 

require_once '../config/Global.php';

Template::header();
    
    try {
        
        $method = filter_input(INPUT_POST, 'metodo');
        
        $livroLista = LivroController::listar();
        
        if($_SESSION['livro_id'] > 0){
            array_push($_SESSION['reserva_livro'], $_SESSION['livro_id']);
            $_SESSION['livro_id'] = 0;
        }
        
        if($method === 'salvar'){
            EmprestimoController::carregarReserva($_SESSION['reserva_livro'], $_SESSION['usuario_id']);
        } elseif ($method === 'excluir') {
            EmprestimoController::excluirReservaSemSalvar(filter_input(INPUT_POST, 'id_livro'));
        } elseif ($method === 'continuar') {
             header('Location: ../view/index.php');
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
            <div class="col-md-8 col-md-offset-1">
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
                            foreach ($_SESSION['reserva_livro'] as $aLivro):
                                foreach($livroLista as $linha){ 
                                    if($linha['id_livro'] == $aLivro){
                                        $idLivro = $linha['id_livro'];
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
                                        <form action='livro_reserva.php' method='POST'>
                                            <input type='hidden' name='id_livro' value='<?php echo $idLivro ?>'>
                                            <input type='hidden' name='metodo' value='excluir'>
                                            <button type='submit' class='btn btn-danger active pe-7s-trash'></button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <form action="livro_reserva.php" method="POST">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type='submit' name="metodo" value="continuar" 
                                                class='btn btn-block btn-success active '>Continuar Reservando</button>
                                    </div>                
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type='submit' name="metodo" value="salvar" 
                                                class='btn btn-block btn-primary active '>Salvar Reserva</button>
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

</body>
<?php 
    Template::footer();
?>