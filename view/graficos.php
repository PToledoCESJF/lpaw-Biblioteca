<?php

require_once '../config/Global.php';
Template::header();

try {

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


    function reservasEmprestimosPorCategoria($tipo, $mes){
        $listaEmpPorCat = EmprestimoController::listarEmprestimoPorCategoria();
        $categorias = array();
        
        if($tipo == 'reservas'){
            foreach ($listaEmpPorCat as $rowEmpPorCat){
                if(date('F', strtotime($rowEmpPorCat['data_reserva'])) == $mes){
                    array_push($categorias, $rowEmpPorCat['nome_categoria']);
                }
            }
        }elseif ($tipo == 'emprestimos') {
            foreach ($listaEmpPorCat as $rowEmpPorCat){
                if(date('F', strtotime($rowEmpPorCat['data_emprestimo'])) == $mes){
                    array_push($categorias, $rowEmpPorCat['nome_categoria']);
                }

            }
        }
        
        $cCategorias = array_count_values($categorias);
        $contaCategorias = array();
        $categoriasIndice = array('Mês');
        $categoriasValor = array($mes);
        foreach ($cCategorias as $c => $ca){
            array_push($categoriasIndice, $c);
            array_push($categoriasValor, $ca);
            $contaCategorias = array_combine($categoriasIndice, $categoriasValor);
        }

        return $contaCategorias;
    }
    
    
    
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
    
    $dadosResEmp = reservaEmprestimo('res_emp', $mesAtual, $mesAnterior, $mesAnterior2);
    $dadosReservas = reservaEmprestimo('reservas', $mesAtual, $mesAnterior, $mesAnterior2);
    $dadosEmprestimos = reservaEmprestimo('emprestimos', $mesAtual, $mesAnterior, $mesAnterior2);

    $reservasAtual = reservasEmprestimosPorCategoria('reservas', $mesAtual);
    $reservasMA = reservasEmprestimosPorCategoria('reservas', $mesAnterior);
    $reservasMA2 = reservasEmprestimosPorCategoria('reservas', $mesAnterior2);
    $dadosReservasCategoria = array($reservasAtual, $reservasMA, $reservasMA2);

    $emprestimosAtual = reservasEmprestimosPorCategoria('emprestimos', $mesAtual);
    $emprestimosMA = reservasEmprestimosPorCategoria('emprestimos', $mesAnterior);
    $emprestimosMA2 = reservasEmprestimosPorCategoria('emprestimos', $mesAnterior2);
    $dadosEmprestimosCategoria = array($emprestimosAtual, $emprestimosMA, $emprestimosMA2);

} catch (Exception $exc) {
        Erro::trataErro($exc);
    }

    // Para que os menus fiquem responsivos, é necessário que 
    // o sidebar() venha antes do navbar()
    Template::sidebar();
    Template::navbar();
?>

    <script type="text/javascript" src="../assets/js/loader.js"></script> 
    
    <script type='text/javascript'>
        google.charts.load('current', {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosReservas)); ?>));

            var options = {
                title: 'Livros Reservados',
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
            var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosEmprestimos)); ?>));

            var options = {
                title: 'Livros Empestados',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('pizzaEmp_div'));
                chart.draw(data, options);
        }
    </script>

    <script type='text/javascript'>
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);
        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosReservasCategoria)); ?>));

            var options = {
                title: 'Reservas por Categoria',
                vAxis: {title: 'Reservas'},
                hAxis: {title: 'Meses'},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('reservaCat_div'));
            chart.draw(data, options);
        }
    </script>
    
    
    <script type='text/javascript'>
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);
        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable((<?= json_encode(convertDataToChartForm($dadosEmprestimosCategoria)); ?>));

            var options = {
                title: 'Emprestimos por Categoria',
                vAxis: {title: 'Emprestimos'},
                hAxis: {title: 'Meses'},
                seriesType: 'bars',
                series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('emprestimoCat_div'));
            chart.draw(data, options);
        }
    </script>
    
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

        
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 card">

                <!-- Primeira linha de Gráficos -->
                <div class="row">

                    <!-- Gráfico 1: livros reservados por mês -->
                    <div class="col-md-6 card">
                        <div id="pizzaRes_div" style='width: 100%; height: 300px; padding: 1%;'></div>
                    </div>
                    <!-- Gráfico 2: livros emprestados por mês -->
                    <div class="col-md-6 card">
                        <div id="pizzaEmp_div" style='width: 100%; height: 300px; padding: 1%;'></div>
                    </div>
                </div>
                
                <!-- Segunda linha de Gráficos -->
                <div class="row">
                
                    <!-- Gráfico 3: livros reservados por categoria -->
                    <div class="col-md-6 card">
                        <div id="reservaCat_div" style="width: 100%; height: 300px; padding: 1%;"></div>
                    </div>
                    <!-- Gráfico 4: livros emprestados por categoria -->
                    <div class="col-md-6 card">
                        <div id="emprestimoCat_div" style="width: 100%; height: 300px; padding: 1%;"></div>
                    </div>
                </div>
                
                <!-- Terceira linha de Gráficos -->
                <div class="row">
                
                    <!-- Gráfico 5: total de livros reservados e emprestados -->
                    <div class="col-md-12 card">
                        <div id="resXemp_div" style="width: 100%; height: 500px;  padding: 1%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
Template::footer();
?>