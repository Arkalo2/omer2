# Framework

Simple php framework use Alto router and twig

## Installation

1. Add dependencies : 

> composer install 

2. Set configuration : 
Before start project, edit and rename config.php.dist to config.php


## Nginx configuration

```nginx
server {
    listen 80;
    root /var/www/html/framework/public;
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

## Documentation

Commin soon...