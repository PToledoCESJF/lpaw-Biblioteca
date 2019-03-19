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
            echo '<pre>';
            print_r('chegou 1');
            echo '</pre>';
            self::inserir($this->categoria);
        }elseif ($this->method === "atualizar") {
            self::atualizar($this->categoria);
        }elseif ($this->method === "excluir") {
            self::excluir($this->categoria);
        }
    }

    public static function atualizar($categoria) {
        CategoriaDAO::atualizar($categoria);
        self::retornar();
    }

    public static function buscaPorId($id) {
        $stmt = CategoriaDAO::BuscarPorId($id);
        $categoria = new Categoria($stmt['id_categoria'], $stmt['nome_categoria'], 
                $stmt['descricao'], $stmt['assunto']);
        return $categoria;
    }

    public static function excluir($categoria) {
        CategoriaDAO::excluir($categoria);
        self::retornar();
    }

    public static function inserir($categoria) {
        try {
            echo '<pre>';
            print_r('chegou 2');
            echo '</pre>';
            CategoriaDAO::inserir($categoria);
            self::retornar();
        } catch (PDOException $exc) {
            Erro::trataErro($exc);
        }
    }

    public static function listar() {
        return CategoriaDAO::listar();
    }
    
    public static function retornar(){
        header('Location: ../view/categoria-novo.php');
    }

}
