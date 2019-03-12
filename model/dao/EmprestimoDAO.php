<?php

class EmprestimoDAO implements ModelDao{
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_emprestimo() VALUES(:)";
            $this->queryListar = "SELECT * FROM tb_emprestimo";
            $this->queryAtualizar = "UPDATE tb_emprestimo SET = :, WHERE = :";
            $this->queryExcluir = "DELETE FROM tb_emprestimo WHERE = :";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }

    public function atualizar(Emprestimo $emprestimo) {
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':', $emprestimo->get());
            $stmt->bindValue(':id_', $emprestimo->getId_());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function excluir($id) {
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function inserir(Emprestimo $emprestimo) {
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':', $emprestimo->get());
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