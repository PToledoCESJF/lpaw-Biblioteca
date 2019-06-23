<?php

require_once '../config/Global.php';

class UsuarioController{
    
    public static function consultaUsuario($email, $senha, $origem){
        $senhaMd5 = md5($senha);
        $usuarioLista = self::listar();
        
        foreach ($usuarioLista as $usuario){
            if($usuario['email'] === $email && $usuario['senha'] === $senhaMd5){
                session_start();
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nome'] = $usuario['nome_usuario'];
                $_SESSION['usuario_grupo'] = $usuario['grupo'];
                $_SESSION['usuario_pesquisa'] = "Selecione um Usuário";
                $_SESSION['usuario_pesquisa_id'] = 0;
                $_SESSION['usuario_logado'] = TRUE;
                $_SESSION['reserva_livro'] = array();
                $_SESSION['emprestimo_idEmpExemp'] = array();
                $_SESSION['emprestimo_exemplar'] = array();
                self::retornar($origem);
            } else {
                echo 'DEU RUIM!!!!';
            }
        }
    }
    
    public static function consultarEmail($email){
        $usuarioLista = self::listar();
        foreach ($usuarioLista as $usuario){
            if($usuario['email'] == $email){
                $idUsuario = $usuario['id_usuario'];
                return self::enviaPorEmail($idUsuario, $email);
            }
        }
        return FALSE;
    }
    
    public static function novaSenha($idUsuario, $senha){
        $senhaMd5 = md5($senha);
        if(UsuarioDAO::novaSenha($idUsuario, $senhaMd5)){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private static function enviaPorEmail($idUsuario, $email){
        
        $retornar = "
            <html><body><div>
            <form action='http://localhost:8090/biblioteca/view/nova_senha.php' method='POST'>
            <p>Esqueceu sua senha?</p>
            <p>Não se preocupe, Clique no botão a baixo e crie uma nova senha.</p>
            <button type='submit' name='id' value='$idUsuario'>Nova Senha</button>
            </form></div></body></html>";
        
        // Load Composer's autoloader
        //require 'vendor/autoload.php';

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';
        
        // Instantiation and passing `true` enables exceptions
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
//        $mail = new PHPMailer(true);

        try {
//            Server settings
//            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'bibliotecasa528@gmail.com';                     // SMTP username
            $mail->Password = 'Agencia32811379';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($email, 'Recuperacao de Senha');
            $mail->addAddress($email);     // Add a recipient
          /*
            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
          */
            // Attachments
          //  $mail->addAttachment('AQUI VAI O ARQUIVO');         // Add attachments
          //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Recuperacao de Senha';
            $mail->Body    = $retornar;
         //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
        
    }
    

    public static function carregar($idUsuario, $nomeUsuario, $sobrenomeUsuario, 
            $grupo, $email, $senha) {
        if($idUsuario == NULL){
            $senhaMd5 = md5($senha);
        } else {
            $senhaMd5 = $senha;
        }
        
        $usuario = new Usuario($idUsuario, $nomeUsuario, $sobrenomeUsuario, 
                $grupo, $email, $senhaMd5);
        self::salvar($usuario);
       
    }

    public static function usuarioLogado() {
    //    return $_SESSION["usuario_logado"];
        return filter_input(INPUT_POST, 'usuario_logado');
    }

    
    public static function carregarVazio() {
        return new Usuario(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    public static function buscaPorId($id) {
        $stmt = UsuarioDAO::BuscarPorId($id);
        return new Usuario($stmt['id_usuario'], $stmt['nome_usuario'], $stmt['sobrenome_usuario'], 
                $stmt['grupo'], $stmt['email'], $stmt['senha']);
    }


    public static function excluir($id) {
        UsuarioDAO::excluir($id);
        
        self::retornar('usuarios.php');
    }

    public static function listar() {
        return UsuarioDAO::listar();
    }

    public static function retornar($origem) {
        if(stristr($origem, 'livro_detalhe')){
            header('Location: ../view/livro_reserva.php');
        } elseif(stristr ($origem, 'usuarios.php')) {
            header('Location:../view/usuarios.php');
        } else {
            header('Location: ../view/index.php');           
        }
    }

    public static function salvar($usuario) {
        try {
            UsuarioDAO::salvar($usuario);
            self::retornar('usuarios.php');
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

            $dados = UsuarioDAO::tabelaDadosPorPagina($paginaAtual, QTD_REGISTROS);           
            $valor = UsuarioDAO::tabelaTotalDeDados();
            
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
                                    <th>Nome</th>
                                    <th>Grupo</th>
                                    <th class='acao'>Editar</th>
                                    <th class='acao'>Excluir</th>
                                </thead>
                                <tbody>";
                foreach($dados as $linha):
                    $grupoUsuario = self::grupoUsuario($linha->grupo);
                echo "
                    <tr>
                        <td>$linha->nome_usuario</td>
                        <td>$grupoUsuario</td>
                        <td>
                            <form action='usuarios.php' method='POST'>
                                <input type='hidden' name='id_usuario' value='$linha->id_usuario'>
                                <input type='hidden' name='metodo' value='editar'>
                                <button type='submit' class='btn btn-info active pe-7s-edit'></button>
                            </form>
                        </td>

                        <td>
                            <form action='usuarios.php' method='POST'>
                                <input type='hidden' name='id_usuario' value='$linha->id_usuario'>
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
    
    private static function grupoUsuario($grupo){
        $grupoLista = ArreiosAuxController::getGrupoUsuario();
        foreach ($grupoLista as $indice => $dado){
            if($grupo == $indice){
                return $dado;
            }
        }
    }
    
    
    
}