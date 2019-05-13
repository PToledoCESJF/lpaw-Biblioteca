<?php

require_once '../config/Global.php';

class UsuarioDAO implements iDao{
    
    public static function inserir($usuario){
        try {
            $conexao = Conexao::conectar();
            $queryInserir = "INSERT INTO tb_usuario(nome, grupo, email, senha) "
                    . "VALUES(:nome, :grupo, :email, :senha)";
            $stmt = $conexao->prepare($queryInserir);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':grupo', $usuario->getGrupo());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function listar(){
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_usuario";
            $stmt = $conexao->query($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function atualizar($usuario){
        try {
            $conexao = Conexao::conectar();
            $queryAtualizar = "UPDATE tb_usuario SET nome = :nome, grupo = :grupo, "
                    . "email = :email, senha = :senha WHERE id_usuario = :id_usuario";
            $stmt = $conexao->prepare($queryAtualizar);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':grupo', $usuario->getGrupo());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha());
            $stmt->bindValue(':id_usuario', $usuario->getId_usuario());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function excluir($id){
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_usuario WHERE id_usuario = :id_usuario";
            $stmt = $conexao->prepare($queryExcluir);
            $stmt->bindValue(':id_usuario', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        
    }

}
