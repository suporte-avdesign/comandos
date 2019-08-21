## Métodos usados
*******
 1. [Instação do Laravel](#install)


*******
<div id='install'/>

* Acessar o servidor
````
# ssh user@ip_do_servidor
````
* Atualização do ubuntu
````
# apt-get update
````
* Instalar o git
````
# apt-get install git
````
* Instalar via setup.sh
````
# nano tmp/setup.sh
````
* Copiar e colar (alterar a senha do mysql)
````
#!/bin/bash

echo "---- Iniciando instalacao do ambiente de Desenvolvimento PHP [AV Design] ---"

echo "--- Atualizando lista de pacotes ---"
sudo apt-get update

echo "--- Definindo Senha padrao para o MySQL e suas ferramentas ---"

DEFAULTPASS="senha_do_mysql"
sudo debconf-set-selections <<EOF
mysql-server	mysql-server/root_password password $DEFAULTPASS
mysql-server	mysql-server/root_password_again password $DEFAULTPASS
dbconfig-common	dbconfig-common/mysql/app-pass password $DEFAULTPASS
dbconfig-common	dbconfig-common/mysql/admin-pass password $DEFAULTPASS
dbconfig-common	dbconfig-common/password-confirm password $DEFAULTPASS
dbconfig-common	dbconfig-common/app-password-confirm password $DEFAULTPASS
phpmyadmin		phpmyadmin/reconfigure-webserver multiselect apache2
phpmyadmin		phpmyadmin/dbconfig-install boolean true
phpmyadmin      phpmyadmin/app-password-confirm password $DEFAULTPASS 
phpmyadmin      phpmyadmin/mysql/admin-pass     password $DEFAULTPASS
phpmyadmin      phpmyadmin/password-confirm     password $DEFAULTPASS
phpmyadmin      phpmyadmin/setup-password       password $DEFAULTPASS
phpmyadmin      phpmyadmin/mysql/app-pass       password $DEFAULTPASS
EOF

echo "--- Instalando pacotes basicos ---"
sudo apt-get install software-properties-common vim curl python-software-properties git-core --assume-yes --force-yes

echo "--- Adicionando repositorio do pacote PHP ---"
sudo add-apt-repository ppa:ondrej/php

echo "--- Atualizando lista de pacotes ---"
sudo apt-get update

echo "--- Instalando MySQL, Phpmyadmin e alguns outros modulos ---"
sudo apt-get install mysql-server-5.7 mysql-client phpmyadmin --assume-yes --force-yes

echo "--- Instalando PHP, Apache e alguns modulos ---"
sudo apt-get install php7.3 php7.3-common --assume-yes --force-yes
sudo apt-get install php7.3-cli libapache2-mod-php7.3 php7.3-mysql php7.3-curl php-memcached php7.3-dev php7.3-mcrypt php7.3-sqlite3 php7.3-mbstring php*-mysql  php-gd php-xml php-mbstring  zip unzip --assume-yes --force-yes

echo "--- Habilitando o PHP 7.3 ---"
sudo a2enmod php7.3

echo "--- Habilitando mod-rewrite do Apache ---"
sudo a2enmod rewrite

echo "--- Reiniciando Apache ---"
sudo service apache2 restart

echo "--- Baixando e Instalando Composer ---"
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

echo "--- Instalando Banco NoSQL -> Redis <- ---" 
sudo apt-get install redis-server --assume-yes
sudo apt-get install php7.3-redis --assume-yes

# Instale apartir daqui o que você desejar 

echo "[OK] --- Ambiente de desenvolvimento concluido ---"

````
* Dar permissão ao arquivo setup.sh
````
# chmod +x setup.sh
````
* Verificar se o arquivo setup.sh tem permissão x
````
# ls -l
````
* Instalar via setup.sh
````
# ./setup.sh
````
* Após instalaçação não esquecer de apagar o arquivo setup.sh
````
# rm -Rf setup.sh
````
* Importante
````
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


# systemctl restart apache2
````
* Caso a pasta www esteja como root root alterar para www-data www-data
````
# ls -l
Parar o apache: # service apache2 stop
Mudar usuário: # chown www-data -R /var/www
Mudar grupo: # chgrp -R www-data /var/www 
Restart apache: # systemctl restart apache2
````
* Altera nome da maquina 
````
# nano /etc/hostname
````

*  Altera nome do usúario 
````
# usermod -l NOVO-MOME NOME-ATUAL
````