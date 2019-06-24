<?php
require_once '../config/Global.php';
require_once '../assets/vendor/autoload.php';

$listaEmprestimos = RelatoriosController::listarReservas();

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
    
    <h2 class='title' style='text-align: center;'>Livros Reservados</h2>
    <hr>";

foreach ($listaEmprestimos as $rowEmp){
    if($rowEmp['exemplar'] == NULL || $rowEmp['data_emprestimo'] == NULL){
        $pagina .= '<strong>Título: ' . $rowEmp['titulo'] . '</strong><br/>';
        $pagina .= '<strong>Usuário:</strong> ' . $rowEmp['nome_usuario']. ' ' . $rowEmp['sobrenome_usuario'] . '<br/>';
        $pagina .= '<strong>Data da Reserva:</strong> ' . date('d/m/Y', strtotime($rowEmp['data_reserva'])). '<br/><hr>';
    }
}

$pagina .= "
    </body>
    </html>";

$footer = "
    <hr>
    <h5 style='text-align: right;'>
        Entre em contato conosco: <br/>
        <i>contato@bibliotecasa.com</i></h5>";

$arquivo = 'Livros-Reservados.pdf';
$mpdf = new Mpdf\Mpdf();
$mpdf->WriteHTML($pagina);
$mpdf->SetHTMLFooter($footer);
$mpdf->Output($arquivo, 'I');

?>