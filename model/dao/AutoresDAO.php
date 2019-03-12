<?php

class AutoresDAO implements ModelDao{
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_autores(nome_autor) VALUES(:nome_autor)";
            $this->queryListar = "SELECT * FROM tb_autores";
            $this->queryAtualizar = "UPDATE tb_autores SET nome_autor = :nome_autor, WHERE id_autores = :id_autores";
            $this->queryExcluir = "DELETE FROM tb_autores WHERE id_autores = :id_autores";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }

    public function atualizar(Autores $autores) {
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':nome_autor', $autores->getNome_autor());
            $stmt->bindValue(':id_autores', $autores->getId_autores());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function excluir($id) {
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_autores', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public function inserir(Autores $autores) {
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':nome_autor', $autores->getNome_autor());
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
