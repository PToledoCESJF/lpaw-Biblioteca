<?php

require_once '../config/Global.php';

class CategoriaController implements iController {
    private $method;
    private $categoria;
    
    public function __construct($method, $categoria) {
        $this->method = $method;
        $this->categoria = $categoria;
    }

    public function carregar(){
        if($this->method === "inserir"){
            /*echo '<pre>';
            print_r('chegou 1');
            echo '</pre>';*/
            self::inserir($this->categoria);
        }elseif ($this->method === "atualizar") {
            self::atualizar($this->categoria);
        }elseif($this->method === "listar"){
            self::listar();
        }elseif($this->method === "excluir") {
            self::excluir($this->categoria);
        }
    }

    public static function atualizar($categoria) {
        CategoriaDAO::atualizar($categoria);
        retornar();
    }

    public static function buscaPorId($id) {
        $stmt = CategoriaDAO::BuscarPorId($id);
        $categoria = new Categoria($stmt['id_categoria'], $stmt['nome_categoria'], 
                $stmt['descricao'], $stmt['assunto']);
        return $categoria;
    }

    public static function excluir($categoria) {
        CategoriaDAO::excluir($categoria);
        retornar();
    }

    public static function inserir($categoria) {
        try {
            CategoriaDAO::inserir($categoria);
            retornar();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        return CategoriaDAO::listar();
    }
    
    public function retornar(){
        header('Location: ../view/categoria-novo.php');
    }

}
