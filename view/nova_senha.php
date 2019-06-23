<?php
    
require_once '../config/Global.php';
    
    try {
        
        $method = filter_input(INPUT_POST, 'metodo');
        
        $usuarioLista = UsuarioController::listar();
        $senha = filter_input(INPUT_POST, 'senha');
        $idUsuario = filter_input(INPUT_POST, 'id');
        
        if($method == 'salvar'){
            if(UsuarioController::novaSenha($idUsuario, $senha)){
                header('Location: ../view/login.php');
            } else {
                $msg = "<h4 class='text-danger'><strong>Não foi possível salvar sua nova senha!</strong></h4>";
            }
            
        } else {
            $msg = "";
        }
    

    } catch (Exception $exc) {
        Erro::trataErro($exc);
    }
    Template::header();

    ?>
<!-- Inicio da Edição -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding: 2%;">
                <div class="card">
                    <div class="col-md-4">
                        <div>
                            <img class='card-img-top img-responsive'
                                 src="../assets/img/sidebar-6.png" 
                                 style="width: 100%; height: 100%;" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5" style="padding: 2%;">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="title"><strong>Recuperação de Senha</strong></h3>
                                </div>
                            </div>

                            <div class="content">
                                <form action="nova_senha.php" method="POST">
                                    <div class="row" style="padding-top: 25%;">
                                        <?php echo $msg ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label form="senha">Nova Senha</label>
                                                <input type="hidden" name="id" value="<?php echo $idUsuario ?>">
                                                <input type="password" name="senha" 
                                                       class="form-control" required placeholder="Senha">
                                            </div>                
                                        </div>                
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    </div>                
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary btn-block active" 
                                                                    name="metodo" value="salvar">Salvar</button>
                                                        </div>                
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
        </div>
    </div>
</div>
