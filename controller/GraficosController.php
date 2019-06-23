<?php

require_once '../config/Global.php';

class GraficosController {
    
    public static function grafico($nome_div){        
        $listaEmpExemp = EmprestimoController::listarEmprestimoExemplar();
        
        $mesAtual = date('F');
        $mesAnterior = date('F', strtotime('-' . 1 . ' months'));
        $mesAnterior2 = date('F', strtotime('-' . 2 . ' months'));
        
        if($nome_div == 1 || $nome_div == 2){
            self::graficoPizza($nome_div, $listaEmpExemp, $mesAtual, $mesAnterior, $mesAnterior2);
        }
    }
        
    private static function graficoPizza($nome_div, $listaEmpExemp, $mesAtual, $mesAnterior, $mesAnterior2){        
        $reservaAtual = 0;
        $reservaAnterior = 0;
        $reservaAnterior2 = 0;
        
        $emprestimoAtual = 0;
        $emprestimoAnterior = 0;
        $emprestimoAnterior2 = 0;
        
        foreach ($listaEmpExemp as $empExemp){            
            if(date('F', strtotime($empExemp['data_reserva'])) == $mesAtual){
                $reservaAtual ++;
            }elseif (date('F', strtotime($empExemp['data_reserva'])) == $mesAnterior) {
                $reservaAnterior ++;
            }elseif (date('F', strtotime($empExemp['data_reserva'])) == $mesAnterior2) {
                $reservaAnterior2 ++;
            }
            
            if(date('F', strtotime($empExemp['data_emprestimo'])) == $mesAtual){
                $emprestimoAtual ++;
            }elseif (date('F', strtotime($empExemp['data_emprestimo'])) == $mesAnterior) {
                $emprestimoAnterior ++;
            }elseif (date('F', strtotime($empExemp['data_emprestimo'])) == $mesAnterior2) {
                $emprestimoAnterior2 ++;
            }
        }
        
        if($nome_div == 1){
            $titulo = 'Livros Reservados';
            $lAtual = $reservaAtual;
            $lAnterior = $reservaAnterior;
            $lAnterior2 = $reservaAnterior2;
            
        } elseif($nome_div == 2){
            $titulo = 'Livros Emprestados';
            $lAtual = $emprestimoAtual;
            $lAnterior = $emprestimoAnterior;
            $lAnterior2 = $emprestimoAnterior2;
        }
        
        echo " 
            <div id=$nome_div style='width: 600px; height: 300px;'></div>
                <script type='text/javascript'>
                    google.charts.load('current', {packages:['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Mes',         'Livros'   ],
                            ['$mesAtual',     $lAtual    ],
                            ['$mesAnterior',  $lAnterior ],
                            ['$mesAnterior2', $lAnterior2]
                        ]);

                        var options = {
                            title: '$titulo',
                            is3D: true,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById($nome_div));
                            chart.draw(data, options);
                    }
                </script>
            ";
    }
}
