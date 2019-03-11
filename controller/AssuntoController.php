<?php

class AssuntoController {
    private $assuntoDao;
    
    public function __construct() {
        $this->assuntoDao = new AssuntoDAO();
    }
    
    public function inserir(Assunto $a){
        $this->assuntoDao->inserir($a);
    }
    
    public function listar(){
        return $this->assuntoDao->listar();
    }
    
    public function atualizar(Assunto $a){
        $this->assuntoDao->atualizar($a);
    }
    
    public function buscaPorId($id_assunto){
        return $this->assuntoDao->buscaPorId($id_assunto);
        //return new Assunto($a['id_assunto'], $a['assunto']);
    }

        public function excluir($id){
        $this->assuntoDao->excluir($id);
    }
}
