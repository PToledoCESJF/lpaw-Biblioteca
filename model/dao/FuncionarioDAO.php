<?php

class FuncionarioDAO {
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_pessoa(nome, grupo, email, senha, funcao) "
                    . "VALUES(:nome, :grupo, :email, :senha, :funcao)";
            $this->queryListar = "SELECT * FROM tb_pessoa";
            $this->queryAtualizar = "UPDATE tb_pessoa SET nome = :nome, grupo = :grupo, "
                    . "email = :email, senha = :senha, funcao = :funcao WHERE id_pessoa = :id_pessoa";
            $this->queryExcluir = "DELETE FROM tb_pessoa WHERE id_pessoa = :id_pessoa";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }
    
    public function inserir(Funcionario $funcionario){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome', $funcionario->getNome());
            $stmt->bindValue(':grupo', $funcionario->getGrupo());
            $stmt->bindValue(':email', $funcionario->getEmail());
            $stmt->bindValue(':senha', $funcionario->getSenha());
            $stmt->bindValue(':funcao', $funcionario->getFuncao());
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
    
    public function atualizar(Funcionario $funcionario){
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':nome', $funcionario->getNome());
            $stmt->bindValue(':grupo', $funcionario->getGrupo());
            $stmt->bindValue(':email', $funcionario->getEmail());
            $stmt->bindValue(':senha', $funcionario->getSenha());
            $stmt->bindValue(':funcao', $funcionario->getFuncao());            
            $stmt->bindValue(':id_pessoa', $funcionario->getId_pessoa());
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
