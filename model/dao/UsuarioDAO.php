<?php


class UsuarioDAO implements iDao{
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_usuario(nome, grupo, email, senha) "
                    . "VALUES(:nome, :grupo, :email, :senha)";
            $this->queryListar = "SELECT * FROM tb_usuario";
            $this->queryAtualizar = "UPDATE tb_usuario SET nome = :nome, grupo = :grupo, "
                    . "email = :email, senha = :senha WHERE id_usuario = :id_usuario";
            $this->queryExcluir = "DELETE FROM tb_usuario WHERE id_usuario = :id_usuario";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }
    
    public function inserir(Usuario $usuario){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':grupo', $usuario->getGrupo());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function listar(){
        try {
            $stmt = $this->conexao->query($this->queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function atualizar(Usuario $usuario){
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
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
    
    public function excluir($id){
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_usuario', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
