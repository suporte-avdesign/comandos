# Deploy com GIT
*******
 1. [Configuração do Servidor](#config-server)
 2. [Configuração Local](#config-local)
 3. [Aumentar Memória (opcional)](#memory)
 4. [Instalação no Servidor](#install)
 4. [Mysql](#mysql)

*******
<div id='config-server'/>

## Configuração do Servidor<br>
Acessar o servidor
>*$ ssh user@ip_do_servidor*

Criar o diretorio com o nome do projeto:
>*# mkdir repo/nome_projeto.git*

>*# cd repo/nome_projeto.git*

```
# git init --bare
# cd hooks
# nano post-receive
```
Escrever o código:
```
#!/bin/sh
GIT_WORK_TREE=/var/www/nome_projeto git checkout -f
```
Da permissão para o arquivo
>*# chmod +x post-receive*


<div id='config-local'/>

## Configuração Local<br>
Adicionar git remote no projeto dos sites:




```
$ git init
$ git add .
$ git remote add nome_projeto ssh://user@ip_do_servidor/repo/nome_projeto.git
$ git commit -m "First commit"
$ git push nome_projeto +master:refs/heads/master
```

Para clonar o projeto
```
$ git init
$ git clone ssh://user@ip_do_servidor/repo/nome_projeto.git
```

* **[*Obs: para remover*](#)**
>*$ git remote remove nome_projeto*

<div id='memory'/>

## Aumentar Memória (opcional)<br>

Isso geralmente é necessário apenas se você estiver operando em um servidor sem muita memória (como uma gota de 512 MB).

Criar um arquivo vazio de 1 GB digitando:
>*# fallocate -l 1G /swapfile*

Formatar como espaço de troca digitando:
>*# mkswap /swapfile*

Habilitar este espaço para que o kernel comece a usá-lo digitando:
>*# swapon /swapfile*

**[*Obs*](#)** : O sistema só usará esse espaço até a próxima reinicialização, mas a única vez em que o servidor provavelmente excederá sua memória disponível é durante os processos de compilação, portanto, isso não deve ser um problema.

<div id='install'/>

## Instalação no Servidor<br>
Concedendo permissões de gravação ao grupo de dados www
````
# service apache2 stop
# chown www-data -R /var/www
# chgrp -R www-data /var/www
# service apache2 start
````
Ou Assim

>*# chown -R www-data:www-data caminho/nome_do_progeto*<br>

Criar o arquivo <strong>.env</strong> e digitar as configurações necessárias.
>*# chmod 777 storage*<br>
>*# composer update*<br>
>*# touch .env*<br>
>*# nano .env*<br>
>*# php artisan key:generate*<br>
>*# composer dump-autoload*<br>

<div id='mysql'/>

## Segurança do Mysql<br>
* Digitar os seguintes comandos:
````
# mysql_secure_installation

- Enter password for user root:Senha

- VALIDATE PASSWORD PLUGIN pode ser usado para testar senhas
  e melhorar a segurança. Verifica a força da senha
  e permite que os usuários definam apenas as senhas que são
  seguro o suficiente. Gostaria de configurar o plugin VALIDATE PASSWORD? No
    
- Remove anonymous users? Y
- Disallow root login remotely? Y
- Remove test database and access to it? Y
- Reload privilege tables now? Y

````
<div id='storage'/>

## Permissões recomendadas<br>
* Define o usuário atual como proprietário e o usuário do servidor web como o grupo
````
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
````
* Configura a permissão do diretório para ser 775 
````
chmod -R 775 storage
chmod -R 775 bootstrap/cache
````




