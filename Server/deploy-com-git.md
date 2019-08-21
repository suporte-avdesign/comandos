# Deploy com GIT
*******
 1. [Configuração no Servidor](#config-server)
 2. [Configuração Local](#config-local)

*******
<div id='config-server'/>

## Configuração no Servidor<br>
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
Adicionar git remote no projeto:

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


