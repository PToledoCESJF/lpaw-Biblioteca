<?php
require_once '../config/Global.php';
require_once '../assets/vendor/autoload.php';

$listaUsuarios = UsuarioController::listar();
$grupoUsuario = ArreiosAuxController::getGrupoUsuario();

$pagina = "
    <html>
    <body>
    <table style='width: 100%;'>
    <thead>
    <th></th>
    <th></th>
    </thead>    
    <tbody>
    <tr>
    <td>
    <img class='card-img-top img-responsive'
    src='../assets/img/logo_livro.jpg' 
    style='width: 90px; height: 100px;' />
    </td>
    <td><h1 style='color: blue;'><strong><i>BiblioteCasa</i></strong></h1></td>
    </tr>
    </tbody>
    </table>
    <hr>
    
    <h2 class='title' style='text-align: center;'>Dados Cadastrais de Usuários</h2>
    <hr>";

foreach ($listaUsuarios as $rowUsuario){
    foreach ($grupoUsuario as $idGrupo => $grupo){
        if($rowUsuario['grupo'] == $idGrupo){
            $pagina .= '<strong>Usuário:<i> ' . $rowUsuario['nome_usuario']. ' ' . $rowUsuario['sobrenome_usuario'] . '</i></strong><br/>';
            $pagina .= '<strong>Email:</strong> ' . $rowUsuario['email'] . '<br/>';
            $pagina .= '<strong>Grupo:</strong> ' . $grupo . '<br/><hr>';
        }
    }
}
  
$pagina .= "
    </body>
    </html>

";

$footer = "
    <hr>
    <h5 style='text-align: right;'>
        Entre em contato conosco: <br/>
        <i>contato@bibliotecasa.com</i></h5>";

$arquivo = 'teste.pdf';
$mpdf = new Mpdf\Mpdf();
$mpdf->WriteHTML($pagina);
$mpdf->SetHTMLFooter($footer);
$mpdf->Output($arquivo, 'I');
?>
