<!DOCTYPE html>
<html>
    <body>
        <?php
            if(isset($_POST['enviar-formulario'])){
                $formatosPermitidos = array("png", "jpeg", "jpg", "gif");
                                
                $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
                
                if(in_array($extensao, $formatosPermitidos)){
                    $pasta = 'arquivos/';
                    $temporario = $_FILES['arquivo']['tmp_name'];
                    $nome = $_FILES['arquivo']['name'];
                    $novoNome = uniqid() . '.' . $extensao;
//                    $_FILES = $novoNome;
                    
//                    echo '<pre>';
//                    print_r($_FILES);
//                    echo '</pre>';
                    
                    echo '<pre>';
                    print_r($nome);
                    echo '</pre>';
//                    
                    if(move_uploaded_file($temporario, $pasta . $nome)){
                        $msg = 'Upload feito com sucesso!';
                    }else{
                        $msg = 'Erro, não foi possível fazer o upload';
                    }
                        
                } else {
                    $msg = 'Formato inválido';
                }
                echo $msg;
            }
            
        ?>
        
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="arquivo"><br>
            <input type="submit" name="enviar-formulario">
        </form>
    </body>
</html>
