# Framework

Simple php framework use Alto router and twig

## Installation

1. Add dependencies : 

> composer install 

2. Set configuration : 
Before start project, edit and rename config.php.dist to config.php

## Configuration

Configurer votre serveur web pour qui redirige tout vers le router ***public/index.php***

### Nginx

```nginx
server {
    listen 80;
    root /var/www/html/omer2/public;
    index index.php index.html index.htm index.nginx-debian.html;
        
    location / {
        try_files $uri /index.php$is_args$args;
    }


    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass 127.0.0.1:9000;
    }

}
```

### Apache

```apache
<VirtualHost *:80>
        ServerName domain.home
        ServerAlias domain.home

        #AddHandler php7-fcgi .php
        #Action php7-fcgi /php7-fcgi
        #Alias /php7-fcgi /usr/lib/cgi-bin/php7-fcgi
        #FastCgiExternalServer /usr/lib/cgi-bin/php7-fcgi -host 127.0.0.1:9000 -pass-header Authorization

        DocumentRoot /var/www/html/omer2/public

        <LocationMatch "^/">
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ /index.php [L]
        </LocationMatch>

        ErrorLog /var/log/apache2/project_error.log
        CustomLog /var/log/apache2/project_access.log combined
</VirtualHost>

```

## Documentation

### Créer une page

Quand un utilisateur demande une page, il passe obligatoirement pour le router ***index.php***. Dans ce router nous décrirons les routes pour qu'il puisse contacter le bon controller. C'est aussi dans ce routeur que vous pourrez rajouter les restrictions à certaines pages. Le controller va lui traiter la requete et afficher la bonne vue. La vue sera un simple rendu HTML.

Donc la création d'une page se fait en ***3 étapes*** : 

#### I/ Le controller

Dans ce framework, c'est au sein du controller que l'on traitera la requete de l'utilisateur. Par exemple c'est On ira chercher les données sur une API, dans une base...

Chaque fonction du controller représente une action différente.

```php
require_once "Controller.php";

class HomeController extends Controller{
    
    public function index(){

        // Votre code

        die("Welcome to Omer2");
        
    }

}
```

#### II/ Parametrage du router

Maintenant, il faut indiquer au framework que la route est disponible est la lier au controller que l'on vient de créer.

```php
$router->map('GET|POST', '/home', "HomeController#index", 'home');
```
Ce code signifie que en accédant en GET ou POST à l'url : *[domain.fr]/home* la fonction ***index*** du ***HomeController*** sera executé. Et cette route s'appelera ***home***.

Si vous lancer dans votre navigateur, vous verrez que à l'url ***/home*** le message du HomeController apparait. 

    Le router utilisé est altorouter pour plus d'info je vous renvoie à la doc officiel de altorouter

#### III/ Template

La dernière partie est le rendu. Pour créer la vue qui correspond à votre route il faut créer un dossier dans le repertoire views. La bonne pratique est de créer un repertoire pour chaque controller.

```
└── views
    ├── base.html.twig
    ├── error
    │   └── 404.html.twig
    └── home
        │   ... 
        └── index.html.twig
```

dans ce repertoire créer autant de vue que vous voulez, souvent une vue correspond à une action ici ***index.html.twig***. 

Exemple de template
```twig
{% extends 'base.html.twig' %}

{% block title %}Home{% endblock %}

{% block body %}
    <h1>Bienvenue sur la page d'accueil !</h1>
{% endblock %}
```

La base des template se situe dans le fichier ***/views/base.html.twig***

Pour plus d'information sur twig je vous renvoie sur la doc officiel

Maintenant il faut juste que notre controller rende la vue.

Dans le controller remplacer le *die("");* par l'appel de la vue.

```php
echo $this->renderer->render('home/index.html.twig');
``` 

Vous pouvez passer des variables à la vue de cette manière

```php
echo $this->renderer->render('home/index.html.twig', array('text' => 'Hello world!'));
``` 

## Authentification

Comming soon...