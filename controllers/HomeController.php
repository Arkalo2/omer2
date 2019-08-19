<?php

require_once "Controller.php";

class HomeController extends Controller{
    
    public function index(){

        echo $this->renderer->render('home/index.html.twig', array('text' => 'Hello world!'));
        
    }

}