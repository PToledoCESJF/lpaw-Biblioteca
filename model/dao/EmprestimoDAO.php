<?php

require_once '../config/Global.php';

class EmprestimoDAO {
 
    public static function salvarReserva($reserva, $usuario){
        try{
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("INSERT INTO tb_emprestimos(usuario) VALUES(:usuario)");
            $stmt->bindValue(':usuario', $usuario);
            $stmt->execute();
            
            $idEmprestimo = self::BuscarUltimoId();
            foreach ($reserva as $livro){
                $stmtItems = $conexao->prepare("INSERT INTO tb_emprestimos_exemplares(emprestimo, livro) "
                        . "VALUES(:emprestimo, :livro)");
                $stmtItems->bindValue(':emprestimo', $idEmprestimo['id_emprestimo']);
                $stmtItems->bindValue(':livro', $livro);
                $stmtItems->execute();
            }
            return TRUE;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    }
    
    private static function BuscarUltimoId() {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("SELECT id_emprestimo FROM tb_emprestimos "
                    . "ORDER BY id_emprestimo DESC LIMIT 1");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

    
    public static function excluirReserva($idEmpExemp) {
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("DELETE FROM tb_emprestimos_exemplares "
                    . "WHERE id_emprestimo_exemplar = :id");
            $stmt->bindValue(':id', $idEmpExemp);
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT * FROM tb_emprestimos";
            $stmt = $conexao->prepare($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listarReservas($idUsuario) {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT em.id_emprestimo, em.usuario, "
                    . "emex.id_emprestimo_exemplar, emex.livro, emex.exemplar, "
                    . "emex.data_emprestimo, emex.data_devolucao "
                    . "FROM tb_emprestimos em INNER JOIN tb_emprestimos_exemplares emex "
                    . "ON em.id_emprestimo = emex.emprestimo WHERE em.usuario = :id_usuario";
            $stmt = $conexao->prepare($queryListar);
            $stmt->bindValue(':id_usuario', $idUsuario);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listarExemplarLivro() {
        try {
            $conexao = Conexao::conectar();
            $queryListar = "SELECT ex.id_exemplar, ex.livro, ex.emprestado, "
                    . "li.imagem "
                    . "FROM tb_exemplares ex INNER JOIN tb_livros li "
                    . "ON ex.livro = li.id_livro";
            $stmt = $conexao->prepare($queryListar);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function BuscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $queryBuscaPorId = "SELECT * FROM tb_emprestimos WHERE id_emprestimo = :id_emprestimo";
            $stmt = $conexao->prepare($queryBuscaPorId);
            $stmt->bindValue(':id_emprestimo', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }
    
        public static function emprestar($idEmprestimo, $idExemplar){
        try {
            $hoje = date("Y-m-d");
            $conexao = Conexao::conectar();
            
            // Insere a data do emprestimo à reserva tornando-a num emprestimo
            $stmtEmp = $conexao->prepare("UPDATE tb_emprestimos_exemplares SET data_emprestimo = :data_emprestimo, "
                    . "exemplar = :exemplar WHERE id_emprestimo_exemplar = :id_emprestimo_exemplar");
            $stmtEmp->bindValue(':data_emprestimo', $hoje);
            $stmtEmp->bindValue(':exemplar', $idExemplar);
            $stmtEmp->bindValue(':id_emprestimo_exemplar', $idEmprestimo);
            $stmtEmp->execute();
            
            // Torna um exemplar emprestado
            $stmtExemp = $conexao->prepare("UPDATE tb_exemplares SET emprestado = :emprestado "
                    . "WHERE id_exemplar = :id_exemplar");
            $stmtExemp->bindValue(':emprestado', 1);
            $stmtExemp->bindValue(':id_exemplar', $idExemplar);
            $stmtExemp->execute();
            
            
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }
    
    public static function renovarEmprestimo($emprestimo){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("INSERT INTO tb_emprestimos(exemplar, usuario, "
                    . "data_emprestimo observacao) "
                    . "VALUES(:exemplar, :usuario, :data_emprestimo, :observacao)");
            $stmt->bindValue(':exemplar', $emprestimo->getExemplar());
            $stmt->bindValue(':usuario', $emprestimo->getUsuario());
            $stmt->bindValue(':data_emprestimo', $emprestimo->getDataEmprestimo());
            $stmt->bindValue(':observacao', $emprestimo->getObservacao());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function devolver($emprestimo){
        try {
            $conexao = Conexao::conectar();
            $stmt = $conexao->prepare("UPDATE tb_emprestimos SET data_devolucao = :data_devolucao "
                    . "WHERE = id_emprestimo :id_emprestimo");

            $stmt->bindValue(':data_devolucao', $emprestimo->getDataDevolucao());
            $stmt->bindValue(':id_emprestimo', $emprestimo->getIdEmprestimo());
            $stmt->execute();
        } catch (Exception $exc) {
            Erro::trataErro($exc);
        }
    }


}
