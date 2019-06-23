<?php
require_once '../config/Global.php';
require_once '../assets/vendor/autoload.php';

$listaEmprestimos = RelatoriosController::listarEmprestimos();

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
    
    <h2 class='title' style='text-align: center;'>Empréstimos em Atraso</h2>
    <hr>";

foreach ($listaEmprestimos as $rowEmp){
    $hoje = strtotime(date('Y-m-d'));
    $previsaoDev = strtotime($rowEmp['data_emprestimo'] . '+' . PRAZO . ' days');
    $atraso = (($hoje - $previsaoDev) / 86400);
    if($rowEmp['data_emprestimo'] > 0 && $rowEmp['data_devolucao'] == NULL && $atraso > 0){
        $pagina .= '<strong>Título: ' . $rowEmp['titulo'] . '</strong><br/>';
        $pagina .= '<strong>Usuário:</strong> ' . $rowEmp['nome_usuario']. ' ' . $rowEmp['sobrenome_usuario'] . '<br/>';
        $pagina .= '<strong>Data do Emprestimo:</strong> ' . date('d/m/Y', strtotime($rowEmp['data_emprestimo'])) . '<br/>';
        $pagina .= '<strong>Previsão de Devolução:</strong> ' . date('d/m/Y', strtotime($rowEmp['data_emprestimo'] . '+' . PRAZO . ' days')) . '<br/>';
        $pagina .= '<strong>Dias em Atraso:</strong> ' . $atraso. '<br/><hr>';
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

$arquivo = 'Emprestimos-em-Atraso.pdf';
$mpdf = new Mpdf\Mpdf();
$mpdf->WriteHTML($pagina);
$mpdf->SetHTMLFooter($footer);
$mpdf->Output($arquivo, 'I');
?>


