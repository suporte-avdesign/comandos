## Configurar Ubuntu
*******
 1. [Virtual Host](#virtual-host)
 2. [Aumentar Memória (opcional)](#swap)

*******
<div id='virtual-host'/>

## Virtual Host<br>
```
# nano /etc/apache2/sites-available/000-default.conf

<VirtualHost *:80>
        ServerAdmin design@anselmovelame.com.br
        ServerName www.dominio.com.br
        ServerAlias dominio.com.br
        DocumentRoot /var/www/nome_projeto/public

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

<VirtualHost *:80>
        ServerName subdominio.dominio.com.br
        DocumentRoot /var/www/dominio/public
</VirtualHost>

<Directory "/var/www">
        AllowOverride All
</Directory>
```

Restart Apache
>*# systemctl restart apache2*

>*# nano /etc/hosts*

Permissões para a pasta www

 * Verificar quem é o usuário 
``` 
# cd /var/www
# ls -l
```
* Caso esteja como root root alterar para www-data www-data
``` 
Parar o apache: # service apache2 stop
Mudar usuário: # chown www-data -R /var/www
Mudar grupo: # chgrp -R www-data /var/www 
Restart apache: # systemctl restart apache2
``` 

<div id='virtual-host'/>

## Aumentar Memória (opcional)<br>

Isso geralmente é necessário apenas se você estiver operando em um servidor sem muita memória (como uma gota de 512 MB).

Criar um arquivo vazio de 1 GB digitando:
>*# fallocate -l 1G /swapfile*

Formatar como espaço de troca digitando:
>*# mkswap /swapfile*

Habilitar este espaço para que o kernel comece a usá-lo digitando:
>*# swapon /swapfile*

**[*Obs*](#)** : O sistema só usará esse espaço até a próxima reinicialização, mas a única vez em que o servidor provavelmente excederá sua memória disponível é durante os processos de compilação, portanto, isso não deve ser um problema.



**[*Virtual Host Personalizados*](#)**

* https://www.digitalocean.com/community/tutorials/como-configurar-apache-virtual-hosts-no-ubuntu-16-04-pt


**[*Configurar DNS CloudFlare*](#)** 
* https://www.cloudflare.com