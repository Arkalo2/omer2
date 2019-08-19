<?php

require "../config.php";

require "../functions.php";

require "../vendor/autoload.php";

$router = new AltoRouter();

$router->map('GET', '/home', "HomeController#index", 'home');

$router->map('GET', '/404', "ErrorController#error404", '404');
$match = $router->match();

if($match){
    
    list($controller, $action) = explode('#', $match['target']);
    
    require_once "../controllers/$controller.php";
    
	if(is_callable(array($controller, $action))) {
        call_user_func_array(array(new $controller, $action), array($match['params']));
    } else {
        // Erreur
	}
	
} else {
    
    require_once "../controllers/ErrorController.php";

    call_user_func_array(array(new ErrorController, 'error404'), []);

}

?>