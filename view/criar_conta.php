<?php
    
require_once '../config/Global.php';
    
    try {
        
        $method = filter_input(INPUT_POST, 'metodo');
        
        if($method == 'salvar'){
            $nome = filter_input(INPUT_POST, 'nome');
            $sobrenome = filter_input(INPUT_POST, 'sobrenome');
            $email = filter_input(INPUT_POST, 'email');
            $senha = filter_input(INPUT_POST, 'senha');
            $grupo = 0;
            $idUsuario = NULL;

            UsuarioController::carregar($idUsuario, $nome, $sobrenome, $grupo, $email, $senha);
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
                                    <h3 class="title"><strong>Nova conta</strong></h3>
                                </div>
                            </div>

                            <div class="content">
                                <form action="criar_conta.php" method="post">
                                    <input type="hidden" name="metodo" value="salvar">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input type="text" name="nome" 
                                                       class="form-control" autofocus required placeholder="Nome">
                                            </div>                
                                            <div class="form-group">
                                                <label for="sobrenome">Sobrenome</label>
                                                <input type="text" name="sobrenome" 
                                                       class="form-control" autofocus required placeholder="Sobrenome">
                                            </div>                
                                            <div class="form-group">
                                                <label form="email">Email</label>
                                                <input type="text" name="email" 
                                                       class="form-control" required placeholder="Email">
                                            </div>                
                                            <div class="form-group">
                                                <label form="senha">Senha</label>
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
                                                            <input type="submit" class="btn btn-primary btn-block active" value="Salvar">
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
                        

