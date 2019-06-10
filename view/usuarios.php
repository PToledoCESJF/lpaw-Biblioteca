<?php
    
require_once '../config/Global.php';

Template::header();
    
    try {
        $usuario = UsuarioController::carregarVazio();
        $usuarioLista = UsuarioController::listar();
        $usuarioGrupo = ArreiosAuxController::getGrupoUsuario();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $idUsuario = filter_input(INPUT_POST, 'id_usuario');
        
        if($method === 'salvar'){
            $nomeUsuario = filter_input(INPUT_POST, 'nome');
            $sobrenomeUsuario = filter_input(INPUT_POST, 'sobrenome');
            $grupo = filter_input(INPUT_POST, 'grupo');
            $email = filter_input(INPUT_POST, 'email');
            $senha = filter_input(INPUT_POST, 'senha');
            
           
            
            /*
            if($imagem == NULL || $imagem != $livro->getImagem()){ 
                $imagensPermitidas = array("png", "jpeg", "jpg", "gif");
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                if(in_array($extensao, $imagensPermitidas)){
                    $pasta = '../assets/img/fotos/';
                    $temporario = $_FILES['imagem']['tmp_name'];
                    $imagem = uniqid() . '.' . $extensao;

                    move_uploaded_file($temporario, $pasta . $imagem);
                }
            }
            */
            UsuarioController::carregar($idUsuario, $nomeUsuario, $sobrenomeUsuario, 
                    $grupo, $email, $senha);
            
        }elseif($method === 'editar'){
            $usuario = UsuarioController::buscaPorId($idUsuario);
        } elseif ($method === 'excluir') {
            UsuarioController::excluir($idUsuario);
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
                        <h3 class="title">Usuários</h3>
                    </div>
                    <div class="content">
                        <form action="usuarios.php" method="POST">
                            <input type="hidden" name="metodo" value="salvar">
                            <input type="hidden" name="senha" value="<?php echo $usuario->getSenha() ?>">
                            <input type="hidden" name="id_usuario" value="<?php echo $usuario->getIdUsuario() ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="nome" 
                                               value="<?php echo $usuario->getNomeUsuario() ?>" 
                                               class="form-control" autofocus required placeholder="Nome">
                                    </div>                
                                    <div class="form-group">
                                        <input type="text" name="sobrenome" 
                                               value="<?php echo $usuario->getSobrenomeUsuario() ?>" 
                                               class="form-control" required placeholder="Sobrenome">
                                    </div>                
                                    <div class="form-group">
                                        <input type="text" name="email" 
                                               value="<?php echo $usuario->getEmail() ?>" 
                                               class="form-control" required placeholder="Email">
                                    </div>                
                                    <div class="form-group">
                                        <label for="grupo">Grupo de usuário</label>
                                        <select class="form-control" name="grupo">
                                            <?php
                                                $selected = '';
                                                foreach ($usuarioGrupo as $indice => $dado){
                                                    if($indice == $usuario->getGrupo()){
                                                        $selected = 'selected';
                                                    }
                                                ?>
                                            <option <?php echo $selected ?> value="<?php echo $indice ?>"><?php echo $dado ?></option>
                                            <?php
                                                    $selected = '';
                                                }
                                            ?>
                                        </select> 
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


<!-- Inicio da Listagem -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h3 class="title">Lista de Usuários</h3>
                        </div>
                        <?php UsuarioController::tabelaPaginada() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Template::footer() ?>
