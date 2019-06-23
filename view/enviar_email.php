<?php
    
require_once '../config/Global.php';
    
    try {
        
        $method = filter_input(INPUT_POST, 'metodo');
        $email = filter_input(INPUT_POST, 'email');
        
        if($method == 'enviar'){
            if(UsuarioController::consultarEmail($email)){
                $msg = "<h4 class='text-success'><strong>Um email foi enviado. Verifique sua caixa de email</strong></h4>";
            } else {
                $msg = "<h4 class='text-danger'><strong>Email não cadastrado</strong></h4>";
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
                                <form action="enviar_email.php" method="POST">
                                    <div class="row" style="padding-top: 25%;">
                                        <?php echo $msg ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label form="email">Email de Login</label>
                                                <input type="text" name="email" 
                                                       class="form-control" required placeholder="Email">
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
                                                                    name="metodo" value="enviar">Recuperar Senha </button>
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
                        

