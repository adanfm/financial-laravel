Este projeto está sendo executado com o Docker para rodar o projeto basta rodar o seguinte comando

```bash
docker-compose up -d
```

Para acessar o container execute o seguinte comando

````bash
docker exec -ti $container_name$ /bin/bash
````

**Comandos mais utilizados**

Compila o projeto em tempo de execução - Utiliza o browser sync
para acessar ele basta rodar http://localhost:3000
````bash
gulp watch 
````

Reseta tudo

````bash
php artisan migrate:refresh --seed
````

Usando o proxy do gulp Watch serve os arquivos do Webpack em memoria

```bash
http://127.0.0.1:8080
```

Executando com o artisan serve
```bash
php artisan serve --port=80
```
