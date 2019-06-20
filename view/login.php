<?php
    
require_once '../config/Global.php';
    
    try {
        $usuarioLista = UsuarioController::listar();
        
        $method = filter_input(INPUT_POST, 'metodo');
        $origem = filter_input(INPUT_POST, 'origem');
        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');
        
        if($method == 'acessar'){
            UsuarioController::consultaUsuario($email, $senha, $origem);
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
            <div class="col-md-12"  style="padding: 4%;">
                
                <div class="card">
                    
                    <div class="col-md-6 col-md-offset-1" style="width: 40%; height: 40%; padding: 3%">
                        <div>
                            <img class='card-img-top img-responsive'
                                 src="../assets/img/logo_livro.jpg" 
                                 style="width: 100%; height: 100%;" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-1" style="padding-top: 15%">
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="title"><strong>Acessar conta</strong></h5>
                                </div>
                                <div class="col-md-4">
                                    ou | <a href='../view/criar_conta.php' class='simple-text'>Criar conta</a>
                                </div>
                            </div>

                            <div class="content">
                                <form action="login.php" method="POST">
                                    <input type="hidden" name="origem" value="<?php echo $_SERVER['HTTP_REFERER'] ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="email" 
                                                       class="form-control" autofocus required placeholder="Email">
                                            </div>                
                                            <div class="form-group">
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
                                                        <a href='../view/enviar_email.php' class='simple-text'>Esqueci a senha</a>
                                                    </div>                
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <input type="submit" class="btn btn-primary btn-block active" 
                                                                   name="metodo" value="acessar">
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
                        

