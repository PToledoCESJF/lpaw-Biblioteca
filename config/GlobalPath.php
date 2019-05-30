<?php

class GlobalPath {
    private $archives;
    
    public function __construct() {
        spl_autoload_register([$this, 'folders']);
    }
    
    private function folders($nomeClasse){
        $this->archives = ['../model/class/' . $nomeClasse . '.php', 
            '../model/dao/' . $nomeClasse . '.php',
            '../controller/' . $nomeClasse . '.php',
            '../config/' . $nomeClasse . '.php'];
        
        foreach ($this->archives as $archive){
            if(file_exists($archive)){
                require_once $archive;
            }
        }
    }
}
new GlobalPath;
