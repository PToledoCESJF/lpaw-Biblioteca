<?php

class AutorController {
    
    public static function carregar($idAutor, $nomeAutor){
        $autor = new Autor($idAutor, $nomeAutor);
        self::salvar($autor);
    }

    public static function carregarVazio(){
        return new Autor(NULL, NULL);
    }
    
    public static function buscaPorId($id) {
        $stmt = AutorDAO::BuscarPorId($id);
        return new Autor($stmt['id_autor'], $stmt['nome_autor']);
    }

    public static function excluir($id) {
        AutorDAO::excluir($id);
        self::retornar();
    }

    public static function salvar($autor) {
        try {
            AutorDAO::salvar($autor);
            self::retornar();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        return AutorDAO::listar();
    }
    
    public static function retornar(){
        header('Location: ../view/autor.php');
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

            $dados = AutorDAO::tabelaDadosPorPagina($paginaAtual, QTD_REGISTROS);
            
            $valor = AutorDAO::tabelaTotalDeDados();
            
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
                                    <th>Autor</th>
                                    <th class='acao'>Editar</th>
                                    <th class='acao'>Excluir</th>
                                </thead>
                                <tbody>";
                foreach($dados as $linha):
                echo "
                    <tr>
                        <td>$linha->id_autor </td>
                        <td>$linha->nome_autor</td>
                        <td>
                            <form action='autor.php' method='POST'>
                                <input type='hidden' name='id_autor' value='$linha->id_autor'>
                                <input type='hidden' name='metodo' value='editar'>
                                <button type='submit' class='btn btn-info active pe-7s-edit'></button>
                            </form>
                        </td>

                        <td>
                            <form action='autor.php' method='POST'>
                                <input type='hidden' name='id_autor' value='$linha->id_autor'>
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
