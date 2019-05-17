<?php

require_once '../config/Global.php';

class ExemplarController implements iController{

    public static function carregar($idExemplar, $livro, $tipoExemplar){
        
        $exemplar = new Exemplar($idExemplar, $livro, $tipoExemplar);
        self::salvar($exemplar);
    }

    public static function carregarVazio(){
        return new Exemplar(NULL, NULL, NULL);
    }
    
    public static function buscaPorId($id) {
        $stmt = ExemplarDAO::BuscarPorId($id);
        return new Exemplar($stmt['id_exemplar'], $stmt['livro'], $stmt['tipo_exemplar']);
    }

    public static function excluir($id) {
        ExemplarDAO::excluir($id);
        self::retornar();
    }

    public static function salvar($exemplar) {
        try {
            ExemplarDAO::salvar($exemplar);
            self::retornar();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        return ExemplarDAO::listar();
    }
    
    public static function retornar(){
        header('Location: ../view/exemplar.php');
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

            $dados = ExemplarDAO::tabelaDadosPorPagina($paginaAtual, QTD_REGISTROS);
            
            $valor = ExemplarDAO::tabelaTotalDeDados();
            
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
                                    <th>id</th>
                                    <th>Livro</th>
                                    <th>Tipo</th>
                                    <th class='acao'>Editar</th>
                                    <th class='acao'>Excluir</th>
                                </thead>
                                <tbody>";
                foreach($dados as $linha):
                echo "
                    <tr>
                        <td>$linha->id_exemplar </td>
                        <td>$linha->livro</td>
                        <td>$linha->tipo_exemplar</td>
                        <td>
                            <form action='exemplar.php' method='POST'>
                                <input type='hidden' name='id_exemplar' value='$linha->id_exemplar'>
                                <input type='hidden' name='metodo' value='editar'>
                                <button type='submit' class='btn btn-info active pe-7s-edit'></button>
                            </form>
                        </td>

                        <td>
                            <form action='exemplar.php' method='POST'>
                                <input type='hidden' name='id_exemplar' value='$linha->id_exemplar'>
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
