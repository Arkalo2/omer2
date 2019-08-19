<?php

class Controller{

    protected $renderer = null;

    public function __construct(){
        
        $loader = new Twig_Loader_Filesystem('../views');
        $this->renderer = new Twig_Environment($loader);

        // Parametre global
        $this->renderer->addGlobal('base_url', HOST);
    }
    
}

