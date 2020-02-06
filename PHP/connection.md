## Conexão com PHP
*******
 1. [Conexão com PDO](#connection-pdo)
 

*******
<div id='connection-pdo'/>

## Conexão com PDO<br>
* Verificando a versão PHP do Apache
````
$ ls /etc/apache2/mods-enabled/php*
````
* Para alternar para a versão 7.3 mais recente, primeiro desative a versão 7.1 antiga do PHP:
```
$ sudo a2dismod php7.1
$ sudo a2enmod php7.3

$ sudo update-alternatives --config php
  Escolher a vesion
```
* Antes de reiniciar o Apache, verifique a sintaxe de configuração do Apache executando:
````
$ apachectl -t
Syntax OK
````
* Se a sintaxe estiver correta, reinicie o Apache:
````
$ sudo service apache2 restart
````