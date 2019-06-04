<?php
session_start();

/*

06/05
dastboard


Gráfico
imagem
composer


*/


require_once '../config/Global.php';



?>

<body>
    <div class="row">
        <div class="col-md-12">
            <h2>Sejá bem-vindo ao Sistema de Controle de Acervo</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <h2>Login</h2>
        
        <form action="../controller/sLogin.php" method="POST">
            <input type="hidden" name="usuario_logado">
            <table class="table">
                <tr>
                    <td>Email</td>
                    <td><input class="form-control" type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Senha</td>
                    <td><input class="form-control" type="password" name="senha"></td>
                </tr>
                <tr>
                    <td><button class="btn btn-primary" type="submit">Login</button></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</body>
