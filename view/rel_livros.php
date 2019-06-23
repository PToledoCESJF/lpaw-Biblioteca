<?php
require_once '../config/Global.php';
require_once '../assets/vendor/autoload.php';

$listaLivros = LivroController::listar();
$listaExemlares = ExemplarController::listar();

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
    
    <h2 style='text-align: center;'>Livros por Exemplares</h2>";
 
foreach($listaLivros as $linha):
$pagina .= "
    <hr>
    <h3><strong>" . $linha['titulo'] . "</strong></h3>
    <table style='width: 100%;'>
    <thead>
    <th></th>
    <th></th>
    </thead>    
    <tbody>
    <tr>
    <td>
    <img src='../assets/img/books/" . $linha['imagem'] . " ' alt='...' 
        style=' width: 100px; height: 140px; padding: 5px;'/>
    </td>
    <td>
    <p><strong> Exemplares </strong></p>";
        foreach ($listaExemlares as $rowExemp){
            if($rowExemp['livro'] == $linha['id_livro']){
               $pagina .= $rowExemp['id_exemplar'] . '<br/>';
            }
        }
$pagina .= "
    </td>
    </tr>
    </tbody>
    </table> ";
endforeach;
$pagina .= "
     <hr>
    </body>
    </html>";

$footer = "
    <hr>
    <h5 style='text-align: right;'>
        Entre em contato conosco: <br/>
        <i>contato@bibliotecasa.com</i></h5>";

$arquivo = 'Livros.pdf';
$mpdf = new Mpdf\Mpdf();
$mpdf->WriteHTML($pagina);
$mpdf->SetHTMLFooter($footer);
$mpdf->Output($arquivo, 'I');

?>

    
    
