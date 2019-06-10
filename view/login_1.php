<?php
    
require_once '../config/Global.php';
    
    try {
        $usuarioLista = UsuarioController::listar();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');
        
        if(UsuarioController::consultaUsuario($email, $senha)){
            
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
                        <div class="col-md-5" style="padding-top: 10%">
                            
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="title"><strong>Acessar conta</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    ou | <a href='../view/criar_conta.php' class='simple-text'>Criar conta</a>
                                </div>
                            </div>

                            <div class="content">
                                <form action="login.php" method="post">
                                    <input type="hidden" name="metodo" value="acessar">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="email" 
                                                       class="form-control" autofocus required placeholder="Email">
                                            </div>                
                                            <div class="form-group">
                                                <input type="password" name="senha" 
                                                       class="form-control" autofocus required placeholder="Senha">
                                            </div>                
                                        </div>                
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href='../view/enviar_email.php' class='simple-text'>Esqueci a senha</a>
                                                    </div>                
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <input type="submit" class="btn btn-primary btn-block active" value="Acessar">
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
                        

