<?php


class UsuarioDAO {
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_pessoa(nome, grupo) "
                    . "VALUES(:nome, :grupo)";
            $this->queryListar = "SELECT * FROM tb_pessoa";
            $this->queryAtualizar = "UPDATE tb_pessoa SET nome = :nome, grupo = :grupo, "
                    . "WHERE id_pessoa = :id_pessoa";
            $this->queryExcluir = "DELETE FROM tb_pessoa WHERE id_pessoa = :id_pessoa";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }
    
    public function inserir(Usuario $usuario){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':grupo', $usuario->getGrupo());
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
            $stmt->bindValue(':id_pessoa', $usuario->getId_pessoa());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function excluir($id){
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_pessoa', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
