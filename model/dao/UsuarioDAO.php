<?php

require_once '../config/Global.php';

class UsuarioDAO implements iDao{
    
    public static function salvar($usuario) {
        try {
            $conexao = Conexao::conectar();
            
            if($usuario->getIdUsuario() != NULL){
                $stmt = $conexao->prepare("UPDATE tb_usuarios SET nome_usuario = :nome, "
                        . "sobrenome_usuario = :sobrenome, grupo = :grupo, "
                        . "email = :email WHERE id_usuario = :id_usuario");
                
                $stmt->bindValue(':id_usuario', $usuario->getIdUsuario());
            }else{
            $stmt = $conexao->prepare("INSERT INTO tb_usuarios(nome_usuario, sobrenome_usuario, "
                    . "grupo, email, senha) VALUES(:nome, :sobrenome, :grupo, :email, :senha)");
            $stmt->bindValue(':senha', $usuario->getSenha());
            }
            $stmt->bindValue(':nome', $usuario->getNomeUsuario());
            $stmt->bindValue(':sobrenome', $usuario->getSobrenomeUsuario());
            $stmt->bindValue(':grupo', $usuario->getGrupo());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function novaSenha($idUsuario, $senha) {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("UPDATE tb_usuarios SET senha = :senha "
                    . "WHERE id_usuario = :id_usuario");

            $stmt->bindValue(':id_usuario', $idUsuario);
            $stmt->bindValue(':senha', $senha);
            $stmt->execute();
            return TRUE;
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function BuscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $queryBuscaPorId = "SELECT * FROM tb_usuarios WHERE id_usuario = :id_usuario";
            $stmt = $conexao->prepare($queryBuscaPorId);
            $stmt->bindValue(':id_usuario', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar(){
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_usuarios";
            $stmt = $conexao->query($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
        
    public static function excluir($id){
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_usuarios WHERE id_usuario = :id_usuario";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_usuario', $id);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function tabelaDadosPorPagina($paginaAtual, $qtdRegistros){
        try {
            $conexao = Conexao::conectar();
            $linhaInicial = ($paginaAtual - 1) * $qtdRegistros;
            $queryConsulta = "SELECT * FROM tb_usuarios LIMIT {$linhaInicial}, {$qtdRegistros}";
            $stmt = $conexao->prepare($queryConsulta);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
        
    public static function tabelaTotalDeDados(){
        try {
            $conexao = Conexao::conectar();
            $queryContador = "SELECT COUNT(*) AS total_registros FROM tb_usuarios";
            $stmtCont = $conexao->prepare($queryContador);
            $stmtCont->execute();

            return $stmtCont->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }



}
