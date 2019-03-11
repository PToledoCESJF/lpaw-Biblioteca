<?php

class Assunto {
    private $id_assunto;
    private $assunto;
    
    public function __construct($id_assunto, $assunto) {
        $this->id_assunto = $id_assunto;
        $this->assunto = $assunto;
    }
    
    public function getId_assunto() {
        return $this->id_assunto;
    }

    public function getAssunto() {
        return $this->assunto;
    }

}
