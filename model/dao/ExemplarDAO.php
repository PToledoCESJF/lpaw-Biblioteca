<?php

class ExemplarDAO {
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_exemplar(livro, circular, numero) "
                    . "VALUES(:livro, :circular, :numero)";
            $this->queryListar = "SELECT * FROM tb_exemplar";
            $this->queryAtualizar = "UPDATE tb_exemplar SET livro = :livro, "
                    . "circular = :circular, numero = :numero WHERE id_exemplar = :id_exemplar";
            $this->queryExcluir = "DELETE FROM tb_exemplar WHERE id_exemplar = :id_exemplar";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }

    public function inserir(Exemplar $exemplar){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':livro', $exemplar->getLivro());
            $stmt->bindValue(':circular', $exemplar->getCircular());
            $stmt->bindValue(':numero', $exemplar->getNumero());
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
    
    public function atualizar(Exemplar $exemplar){
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':livro', $exemplar->getLivro());
            $stmt->bindValue(':circular', $exemplar->getCircular());
            $stmt->bindValue(':numero', $exemplar->getNumero());
            $stmt->bindValue(':id_exemplar', $exemplar->getId_exemplar());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function excluir($id){
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_exemplar', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
