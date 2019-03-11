<?php

class LivroDAO {
    private $conexao;
    private $queryInserir;
    private $queryListar;
    private $queryAtualizar;
    private $queryExcluir;
    
    public function __construct() {
        try {
            $this->conexao = Conexao::conectar();
            $this->queryInserir = "INSERT INTO tb_livro(titulo, isbn, autores, edicao, "
                    . "editora, ano, assunto, upload) VALUES(:titulo, :isbn, :autores, :edicao, "
                    . ":editora, :ano, :assunto, :upload)";
            $this->queryListar = "SELECT * FROM tb_livro";
            $this->queryAtualizar = "UPDATE tb_livro SET  titulo = :titulo, isbn = :isbn, "
                    . "autores = :autores, edicao = :edicao, editora = :editora, ano = :ano, "
                    . "assunto = :assunto, upload = :upload WHERE id_livro = :id_livro";
            $this->queryExcluir = "DELETE FROM tb_livro WHERE id_livro = :id_livro";
        } catch (Exception $exc) {
            Erro::trataErro($exc);            
        }
    }
    
    public function inserir(Livro $livro){
        try {
            $stmt = $this->conexao->prepare($this->queryInserir);
            $stmt->bindValue(':titulo', $livro->getTitulo());
            $stmt->bindValue(':isbn', $livro->getIsbn());
            $stmt->bindValue(':autores', $livro->getAutores());
            $stmt->bindValue(':edicao', $livro->getEdicao());
            $stmt->bindValue(':editora', $livro->getEditora());
            $stmt->bindValue(':ano', $livro->getAno());
            $stmt->bindValue(':assunto', $livro->getAssunto());
            $stmt->bindValue(':upload', $livro->getUpload());
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
    
    public function atualizar(Livro $livro){
        try {
            $stmt = $this->conexao->prepare($this->queryAtualizar);
            $stmt->bindValue(':titulo', $livro->getTitulo());
            $stmt->bindValue(':isbn', $livro->getIsbn());
            $stmt->bindValue(':autores', $livro->getAutores());
            $stmt->bindValue(':edicao', $livro->getEdicao());
            $stmt->bindValue(':editora', $livro->getEditora());
            $stmt->bindValue(':ano', $livro->getAno());
            $stmt->bindValue(':assunto', $livro->getAssunto());
            $stmt->bindValue(':upload', $livro->getUpload());            
            $stmt->bindValue(':id_livro', $livro->getId_livro());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public function excluir($id){
        try {
            $stmt = $this->conexao->prepare($this->queryExcluir);
            $stmt->bindValue(':id_livro', $id);
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
}