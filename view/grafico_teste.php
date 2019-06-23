<?php

require_once '../config/Global.php';


    $mesAtual = date('F');
    $mesAnterior = date('F', strtotime('-' . 1 . ' months'));
    $mesAnterior2 = date('F', strtotime('-' . 2 . ' months'));
    
    function reservaEmprestimo($tipo, $mesAtual, $mesAnterior, $mesAnterior2){
        $listaEmpExemp = EmprestimoController::listarEmprestimoExemplar();
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
        
        if($tipo == 'res_emp'){
            $rXeAtual = array('Mês' => $mesAtual, 'Reserva' => $reservaAtual, 'Emprestimo' => $emprestimoAtual);
            $rXeAnterior = array('Mês' => $mesAnterior, 'Reserva' => $reservaAnterior, 'Emprestimo' => $emprestimoAnterior);
            $rXeAnterior2 = array('Mês' => $mesAnterior2, 'Reserva' => $reservaAnterior2, 'Emprestimo' => $emprestimoAnterior2, );
            return array($rXeAtual, $rXeAnterior, $rXeAnterior2);
        }elseif ($tipo == 'reservas') {
            $reservasAtual = array('Mês' => $mesAtual, 'Reserva' => $reservaAtual);
            $reservasMA = array('Mês' => $mesAnterior, 'Reserva' => $reservaAnterior);
            $reservasMA2 = array('Mês' => $mesAnterior2, 'Reserva' => $reservaAnterior2);
            return array($reservasAtual, $reservasMA, $reservasMA2);
        }elseif ($tipo == 'emprestimos') {
            $emprestimosAtual = array('Mês' => $mesAtual, 'Emprestimo' => $emprestimoAtual);
            $emprestimosMA = array('Mês' => $mesAnterior, 'Emprestimo' => $emprestimoAnterior);
            $emprestimosMA2 = array('Mês' => $mesAnterior2, 'Emprestimo' => $emprestimoAnterior2, );
            return array($emprestimosAtual, $emprestimosMA, $emprestimosMA2);
        }
    }

    $dadosResEmp = reservaEmprestimo('res_emp', $mesAtual, $mesAnterior, $mesAnterior2);
    $dadosRes = reservaEmprestimo('reservas', $mesAtual, $mesAnterior, $mesAnterior2);
    $dadosEmp = reservaEmprestimo('emprestimos', $mesAtual, $mesAnterior, $mesAnterior2);
    

    function convertDataToChartForm($data){
        $newData = array();
        $firstLine = true;

        foreach ($data as $dataRow)
        {
            if ($firstLine)
            {
                $newData[] = array_keys($dataRow);
                $firstLine = false;
            }

            $newData[] = array_values($dataRow);
        }

        return $newData;
    }

?>


<html>
  <head>
    <script type="text/javascript" src="../assets/js/loader.js"></script>
    
    
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {        
            var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosResEmp)); ?>));

            var options = {
                title: 'Reservas X Emprestimos',
                vAxis: {title: 'Livros'},
                hAxis: {title: 'Meses'},
                         
            };

            var chart = new google.visualization.LineChart(document.getElementById('resXemp_div'));

            chart.draw(data, options);
        }
    </script>
    
    
    <script type='text/javascript'>
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosda)); ?>));

            var options = {
                title: 'Reservas por Categoria',
                vAxis: {title: 'Reservas'},
                hAxis: {title: 'Meses'},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('reserva_div'));
            chart.draw(data, options);
        }
    </script>
    
    
    <script type='text/javascript'>
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
                // Some raw data (not necessarily accurate)
                var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosEmprestimos)); ?>));

                var options = {
                    title: 'Emprestimos por Categoria',
                    vAxis: {title: 'Emprestimos'},
                    hAxis: {title: 'Meses'},
                    seriesType: 'bars',
                    series: {5: {type: 'line'}}
                };

                var chart = new google.visualization.ComboChart(document.getElementById('emprestimo_div'));
                chart.draw(data, options);
            }
        </script>
        
        <script type='text/javascript'>
            google.charts.load('current', {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosRes)); ?>));

                var options = {
                    title: '$titulo',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('pizzaRes_div'));
                    chart.draw(data, options);
            }
        </script>
        
        <script type='text/javascript'>
            google.charts.load('current', {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosEmp)); ?>));

                var options = {
                    title: '$titulo',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('pizzaEmp_div'));
                    chart.draw(data, options);
            }
        </script>
    
  </head>
  <body>
    <!--
    <div id="reserva_div" style="width: 900px; height: 500px"></div>
    <div id="emprestimo_div" style="width: 900px; height: 500px"></div>
    -->
    <div id="resXemp_div" style="width: 900px; height: 500px"></div>
    <div id="pizzaRes_div" style='width: 900px; height: 500px;'></div>
    <div id="pizzaEmp_div" style='width: 900px; height: 500px;'></div>
    
  </body>
</html>