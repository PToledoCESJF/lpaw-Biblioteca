<?php

class AssuntoDAO {
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    private $queryBuscarPorId;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_assunto(assunto) VALUES(:assunto)";
            $this->queryListar = "SELECT * FROM tb_assunto";
            $this->queryAtualizar = "UPDATE tb_assunto SET assunto = :assunto WHERE id_assunto = :id_assunto";
            $this->queryExcluir = "DELETE FROM tb_assunto WHERE id_assunto = :id_assunto";
            $this->queryBuscarPorId = "SELECT * FROM tb_assunto WHERE id_assunto = :id_assunto";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }
    
    public function inserir(Assunto $assunto){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':assunto', $assunto->getAssunto());
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
    
    public function atualizar(Assunto $assunto){
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':assunto', $assunto->getAssunto());
            $stmt->bindValue(':id_assunto', $assunto->getId_assunto());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function buscaPorId($id_assunto){
        try {
            $stmt = $this->conexao->prepare($this->queryBuscarPorId);
            $stmt->bindValue(':id_assunto', $id_assunto);
            $stmt->execute();
            $a = $stmt->fetch();
            $ass = new Assunto($a['id_assunto'], $a['assunto']);
            return $ass;
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function excluir($id){
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_assunto', $id);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}
