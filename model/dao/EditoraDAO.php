<?php

class EditoraDAO implements iDao{
    
    public function __construct() {
        try {
            
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }

    public function atualizar(Editora $editora) {
        try {
            $conexao = Conexao::conectar();
            $queryAtualizar = "UPDATE tb_editora SET nome_editora = :nome_editora, WHERE id_editora = :id_editora";
            $stmt = $conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':nome_editora', $editora->getNome_editora());
            $stmt->bindValue(':id_editora', $editora->getId_editora());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function excluir($id) {
        try {
            $conexao = Conexao::conectar();
            $queryExcluir = "DELETE FROM tb_editora WHERE id_editora = :id_editora";
            $stmt = $conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_editora', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function inserir(Editora $editora) {
        try {
            $conexao = Conexao::conectar();
            $queryInserir = "INSERT INTO tb_editora(nome_editora) VALUES(:nome_editora)";
            $stmt = $conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome_editora', $editora->getNome_editora());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function listar() {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_editora";
            $stmt = $conexao->query($this->queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        
    }

}
