<?php

class EmprestimoController {
    
    public static function carregarReserva($reserva, $usuario){
        try {
            if(count($reserva) >  0){
                if(EmprestimoDAO::salvarReserva($reserva, $usuario)){

                    foreach ($_SESSION['reserva_livro'] as $indice => $livro){
                        $result = array_search($livro, $_SESSION['reserva_livro']);
                        unset($_SESSION['reserva_livro'][$result]);
                    }
                }
            }
            
            self::retornar('salvar');
            
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function carregarVazio() {
        return new Emprestimo(NULL, NULL, NULL, NULL);
    }
    
    public static function buscaPorId($id) {
        $stmt = LivroDAO::BuscarPorId($id);
        $stmt = EmprestimoDAO::BuscarPorId($id);
        $reserva = new Emprestimo($stmt['id_emprestimo'], $stmt['exemplar'], 
                $stmt['usuario'], $stmt['observacao']);
        return $reserva;
    }

    public static function listar() {
        return EmprestimoDAO::listar();
    }
    
    public static function listarReservas($idUsuario){
        return EmprestimoDAO::listarReservas($idUsuario);
    }

    private static function retornar($origem){
        if ($origem == 'salvar'){
            header('Location: ../view/reservas.php?w3wb=ds1fa5d4f53');            
        }elseif ($origem == 'excluirSemSalvar') {
            header('Location: ../view/livro_reserva.php');
        }elseif ($origem == 'excluirRes') {
            header('Location: ../view/reservas.php?w3wb=ed12f8h423h');
        }elseif ($origem == 'reservado') {
            header('Location: ../view/reservas.php?w3wb=ed12f8h423h');            
        }
    }
    
    // Método que excluir uma reserva antes de ser salva no banco 
    public static function excluirReservaSemSalvar($idLivro){
        if(isset($idLivro)){
            $result = array_search($idLivro, $_SESSION['reserva_livro']);
            unset($_SESSION['reserva_livro'][$result]);
        
            self::retornar('excluirSemSalvar');
        }
    }
        
    // Método que excluir uma reserva salva no banco porém antes de se tornar empréstimo
    public static function excluirReserva($idEmpExemp){
        try {
            EmprestimoDAO::excluirReserva($idEmpExemp);
            self::retornar('excluirRes');
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listarExemplarLivro(){
        try {
            return EmprestimoDAO::listarExemplarLivro();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listarEmprestimoExemplar() {
        try {
            return EmprestimoDAO::listarEmprestimoExemplar();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listarEmprestimoPorCategoria() {
        try {
            return EmprestimoDAO::listarEmprestimoPorCategoria();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function emprestar($emprestimoLista){
        try {
            
            foreach ($emprestimoLista as $idEmprestimo => $idExemplar){
                EmprestimoDAO::emprestar($idEmprestimo, $idExemplar);
            }
            
            self::retornar('reservado');
            
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function renovarEmprestimo($emprestimo){

    }

    public static function devolver($idEmpExemp, $idExemplar){
        try {
            EmprestimoDAO::devolver($idEmpExemp, $idExemplar);
            return TRUE;
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    
    }
     
    public static function tabelaPaginada(){
        try {
            
            $endereco = $_SERVER['PHP_SELF'];
            define('QTD_REGISTROS', 4);
            define('RANGE_PAGINAS', 1);
            $paginaAtual = filter_input(INPUT_GET, 'page');
            if(empty($paginaAtual)){
                $paginaAtual = 1;
            }

            $dados = LivroDAO::tabelaDadosPorPagina($paginaAtual, QTD_REGISTROS);
            
            $valor = LivroDAO::tabelaTotalDeDados();
            
            $primeiraPagina = 1;
            $ultimaPagina = ceil($valor->total_registros / QTD_REGISTROS);
            $paginaAnterior = ($paginaAtual > 1) ? $paginaAtual + 1 : 0;
            $proximaPagina = ($paginaAtual < $ultimaPagina) ? $paginaAtual + 1 : 0;
            $rangeInicial = (($paginaAtual - RANGE_PAGINAS) >= 1) ? $paginaAtual - RANGE_PAGINAS : 1;
            $rangeFinal = (($paginaAtual + RANGE_PAGINAS) <= $ultimaPagina) ? $paginaAtual + RANGE_PAGINAS : $ultimaPagina;
            $botaoInicio = ($rangeInicial  < $paginaAtual) ? 'mostrar' : 'esconder';
            $botaoFinal = ($rangeFinal  > $paginaAtual) ? 'mostrar' : 'esconder';
            
            if(!empty($dados)){
                echo "
                    <div class='content table-responsive table-full-width'>
                            <table class='table table-hover table-striped'>
                                <thead>
                                    <th>Título</th>
                                    <th class='acao'>Editar</th>
                                    <th class='acao'>Excluir</th>
                                </thead>
                                <tbody>";
                foreach($dados as $linha):
                echo "
                    <tr>
                        <td>$linha->titulo</td>
                        <td>
                            <form action='livros.php' method='POST'>
                                <input type='hidden' name='id_livro' value='$linha->id_livro'>
                                <input type='hidden' name='metodo' value='editar'>
                                <button type='submit' class='btn btn-info active pe-7s-edit'></button>
                            </form>
                        </td>

                        <td>
                            <form action='livros.php' method='POST'>
                                <input type='hidden' name='id_livro' value='$linha->id_livro'>
                                <input type='hidden' name='metodo' value='excluir'>
                                <button type='submit' class='btn btn-danger active pe-7s-trash'></button>
                            </form>
                        </td>
                    </tr>";
                endforeach;
                echo "
                    </tbody>
                </table>
                
                 <div class='pagination'>
                        <a class='pagination $botaoInicio' href='$endereco?page=$primeiraPagina' title='Primeira Página'>Primeira |</a>
                        <a class='pagination $botaoInicio' href='$endereco?page=$paginaAnterior' title='Página Anterior'>Anterior |</a>
                    </div>";
                for($i = $rangeInicial; $i <= $rangeFinal; $i++){
                    $destaque = ($i == $paginaAtual) ? 'destaque' : '';
                    echo "<a class='pagination $destaque' href='$endereco?page=$i'>$i</a>";
                }
                
                echo "
                    <a class='pagination $botaoFinal' href='$endereco?page=$proximaPagina' title='Próxima Página'>| Próxima</a>
                    <a class='pagination $botaoFinal' href='$endereco?page=$ultimaPagina' title='Última Página'>| Última</a>
            </div>";
                
            }else{
                echo "
                <p class='bg-danger'>Nenhum registro encontrado!</p>";
            }
            
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
