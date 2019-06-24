<?php
    
require_once '../config/Global.php';

Template::header();
    
    try {

        
        $method = filter_input(INPUT_POST, 'metodo');
        
        if($method === 'salvar'){
            $nomeUsuario = filter_input(INPUT_POST, 'nome');
            $sobrenomeUsuario = filter_input(INPUT_POST, 'sobrenome');
            $grupo = filter_input(INPUT_POST, 'grupo');
            $email = filter_input(INPUT_POST, 'email');
            $senha = filter_input(INPUT_POST, 'senha');
    
            UsuarioController::carregar($idUsuario, $nomeUsuario, $sobrenomeUsuario, 
                    $grupo, $email, $senha);
        } else {
            $usuario = UsuarioController::buscaPorId($_SESSION['usuario_id']);
            $usuarioGrupo = ArreiosAuxController::getGrupoUsuario();
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
                                        <label for="grupo">Nome</label>
                                        <input type="text" name="nome" 
                                               value="<?php echo $usuario->getNomeUsuario() ?>" 
                                               class="form-control" autofocus required placeholder="Nome">
                                    </div>                
                                    <div class="form-group">
                                        <label for="grupo">Sobrenome</label>
                                        <input type="text" name="sobrenome" 
                                               value="<?php echo $usuario->getSobrenomeUsuario() ?>" 
                                               class="form-control" required placeholder="Sobrenome">
                                    </div>                
                                    <div class="form-group">
                                        <label for="grupo">Email</label>
                                        <input type="text" name="email" 
                                               value="<?php echo $usuario->getEmail() ?>" 
                                               class="form-control" required placeholder="Email">
                                    </div>                
                                    <div class="form-group">
                                        <label for="grupo">Grupo de usuário</label>
                                            <?php
                                                foreach ($usuarioGrupo as $indice => $dado){
                                                    if($indice == $usuario->getGrupo()){?>
                                                    <input type="text" name="grupo" value="<?php echo $dado ?>"
                                                           class="form-control" disabled="true">
                                                    <?php
                                                   }
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
</div>

<?php Template::footer() ?>
