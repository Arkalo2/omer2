<?php

require_once "Controller.php";

class ErrorController extends Controller{
    
    public function error404(){

        echo $this->renderer->render('error/404.html.twig', array('text' => 'Hello world!'));
        
    }

}