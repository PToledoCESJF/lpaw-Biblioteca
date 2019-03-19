<?php

class EditoraDAO implements iDao{
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_editora(nome_editora) VALUES(:nome_editora)";
            $this->queryListar = "SELECT * FROM tb_editora";
            $this->queryAtualizar = "UPDATE tb_editora SET nome_editora = :nome_editora, WHERE id_editora = :id_editora";
            $this->queryExcluir = "DELETE FROM tb_editora WHERE id_editora = :id_editora";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }

    public function atualizar(Editora $editora) {
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':nome_editora', $editora->getNome_editora());
            $stmt->bindValue(':id_editora', $editora->getId_editora());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function excluir($id) {
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_editora', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function inserir(Editora $editora) {
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome_editora', $editora->getNome_editora());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function listar() {
        try {
            $stmt = $this->conexao->query($this->queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

}
