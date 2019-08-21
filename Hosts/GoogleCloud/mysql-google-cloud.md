# Google Cloud Mysql

*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação

* Menu -> SQL -> Criar Instância -> Mysql
````
Código da instância: bd-nome-projeto
Senha raiz: senha_do_bd
Região: Quelquer uma
Zona: Qualquer uma
````
* Acessar a Instância -> Banco de Dados 
````
utf8 - utf8_general_ci
````
* Conectar-se a esta instância
````
Endereço IP público: x.x.x.x.x

Nome da conexão da instância: bd-xpto
````
* Ver todos os mètodos de conexão

**[*Utilizando o Cloud SQL Proxy*](#)**

* https://cloud.google.com/sql/docs/mysql/connect-external-app#proxy

* Faça o download do proxy:
````
wget https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 -O cloud_sql_proxy
chmod +x cloud_sql_proxy
````
* Ativar a API
     - Enable the Cloud SQL Admin API.
     - Clique em ENABLE THE API

* Seleciona o Projeto -> Continuar

* IAM E ADMIN -> Contas de Serciço

* Seleciona a Instância -> Ações -> Criar Chave
````
Remomera arquivos: 
    cloud_sql_proxy.json
    chave_proxy.json
Adicionar  aos arquivos 
    .gcloudignore
    .gitignore 
````
* Menu -> SQL -> Instância

* Acesse ao BD via terminal na pasta do projeto com cloud_sql_proxy
````
- Criando conexão com banco de dados
#DB_HOST=127.0.0.1
#DB_PORT=3307
#DB_DATABASE=nome_bd
#DB_USERNAME=user
#DB_PASSWORD=password

./cloud_sql_proxy -instances="nome_instancia"=tcp:3307 -credential_file=chave-bd.json 
````
* Abrir outro terminal
````
php artisan migrate
````
**[*Fontes*](#)**

* Metódos de Conexão

https://cloud.google.com/sql/docs/mysql/external-connection-methods?hl=pt_BR

* Como configurar o acesso remoto ao MySQL

https://cloud.google.com/solutions/mysql-remote-access

* Como diagnosticar problemas nas instâncias do Cloud SQL
https://cloud.google.com/sql/docs/mysql/diagnose-issues?hl=pt-br


