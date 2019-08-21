# Como Instalar e Proteger
*******
 1. [Instalar](#install)
 2. [Proteger](#protect)
 
 

*******
<div id='install'/>

## Instalar

>*$ sudo apt-get update*

>*$ sudo apt-get install phpmyadmin php-mbstring php-gettext*

```
- Para seleção do servidor, escolha apache2.
- Selecione yes quando perguntado se é para usar dbconfig-common para configurar o banco de dados
- Você será solicitado a fornecer a senha do administrador do banco de dados
- Você será solicitado a escolher e confirmar uma senha para a própria aplicação phpMyAdmin
```
* O processo de instalação na verdade adiciona o arquivo de configuração Apache do phpMyAdmin dentro do diretório /etc/apache2/conf-enabled/, onde ele é automaticamente lido.

* Habilitar explicitamente as extensões PHP mcrypt e mbstring

>*$ sudo phpenmod mcrypt*

>*$ sudo phpenmod mbstring*

>*$ sudo systemctl restart apache2*

* https://nome_de_domínio_ou_ip/phpmyadmin


<div id='protect'/>

## Proteger

* Colocar um gateway na frente de toda a aplicação. 
```
# nano /etc/apache2/conf-available/phpmyadmin.conf
```

* Adicionar uma diretiva AllowOverride All dentro da seção:
```
<Directory /usr/share/phpmyadmin>
    Options FollowSymLinks
    DirectoryIndex index.php
    AllowOverride All
    . . .
```
* Salve e feche o arquivo e reinicie o Apache:
>*# systemctl restart apache2*

* Criar um arquivo .htaccess com privilégios de root digitando:
>*# nano /usr/share/phpmyadmin/.htaccess*

* Entrar com a seguinte informação:
```
AuthType Basic
AuthName "Restricted Files"
AuthUserFile /etc/phpmyadmin/.htpasswd
Require valid-user
```
* Criar o arquivo .htpasswd para Autenticação
>*# apt-get install apache2-utils*

* Depois, teremos o utilitário htpasswd disponível.
  
  A localização que selecionamos para o arquivo de senhas era "/etc/phpmyadmin/.htpasswd". Vamos criar esse arquivo e passá-lo um usuário inicial digitando:
  
>*# htpasswd -c /etc/phpmyadmin/.htpasswd nome_de_usuário*

* Você será solicitado a selecionar e confirmar uma senha para o usuário que você está criando. Em seguida, o arquivo é criado com o hash de senha que você digitou.

* Se você quiser inserir um usuário adicional, você precisa fazê-lo sem o modificador -c, como abaixo:
>*# htpasswd /etc/phpmyadmin/.htpasswd usuário_adicional*


**[*Fontes*](#)**

* https://www.digitalocean.com/community/tutorials/como-instalar-e-proteger-o-phpmyadmin-no-ubuntu-16-04-pt
