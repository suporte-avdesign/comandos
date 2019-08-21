# Configuração e gerar SSH
*******
 1. [Gerar um Par de Chaves (SSH)](#ssh-keygen)
 2. [Copiar a Chave Pública](#id-rsa-pub)
 3. [Erro SSH no Oceano Digital: “Permissão negada (publickey)”](#permissao-negada)

*******
<div id='ssh-keygen'/>

## Gerar um Par de Chaves (SSH)<br>
Digite o seguinte comando no terminal de sua máquina local
>*$ ssh-keygen*

Assumindo que seu usuário local chame-se "localuser", você verá uma saída que se parece com o seguinte:
```
Generating public/private rsa key pair.
Enter file in which to save the key (/Users/localuser/.ssh/id_rsa):
```
Tecle ENTER para aceitar este nome de arquivo e o path (ou entre com um novo nome).<br>
Depois, será solicitado uma senha para proteger sua chave. Você pode digitar uma senha ou deixar a senha em branco.
```
Nota: Se você deixar a senha em branco, você será capaz de utilizar a chave privada para autenticação sem entrar com uma senha. Se você colocar uma senha, você precisará tanto da chave privada quanto da senha para efetuar login. A proteção de suas chaves com uma senha é mais segura, mas os dois métodos tem seus usos e são mais seguros do que a autenticação básica com senha somente.
```
Isto gera uma chave privada, id_rsa, e uma chave pública, id_rsa.pub, no diretório .ssh do diretório home de localuser. Lembre-se de que a chave privada não deve ser compartilhada com ninguém que não deva ter acesso ao seus servidores!

<div id='id-rsa-pub'/>

## Copiar a Chave Pública<br>
Depois da geração do par de chaves SSH, você vai querer copiar sua chave pública para seu novo servidor. Vamos cobrir duas formas simples de se fazer isso.
* **[*Opção 1: Usar ssh-copy-id*](#)** : Se a sua máquina local possui o script ssh-copy-id instalado, você pode usá-lo para instalar sua chave pública para qualquer usuário para o qual você tenha as credenciais de login.<br>
Execute o script ssh-copy-id especificando o usuário e o endereço IP do servidor onde você deseja instalar a chave, como abaixo:
>*$ ssh-copy-id user@ip_do_seu_servidor*

Alterar configurações de segurança:
>*# vim /etc/ssh/sshd_config*
```
UsePAM yes
IgnoreUserKnownHosts no
PasswordAuthentication no 
```
>*# vim /etc/ssh/sshd_config*

sair do editor vim:
>*esc:wqenter*
 
Restart o SSH
>*# service sshd restart*


* **[*Opção 2: Instalar a chave manualmente*](#)** : 
https://www.digitalocean.com/community/tutorials/configuracao-inicial-de-servidor-com-ubuntu-16-04-pt



<div id='permissao-negada'/>

## Erro SSH: Permissão negada (publickey)<br>
Como corrigir isso: Reset o Password<br>
Abra o console do droplet, entre com a senha enviada para o email, defina uma nova senha e digite no console:
>*# vim /etc/ssh/sshd_config*

Mude para o oposto:
```
UsePAM yes
IgnoreUserKnownHosts no
PasswordAuthentication no 

UsePAM no
IgnoreUserKnownHosts no
PasswordAuthentication yes
```
sair do editor vim:
>*esc:wqenter*

Restart o SSH
>*# service sshd restart*

Abra o terminal do seu computador e digite o comando abaixo e a nova senha:
>*$ ssh user@ip_do_server*

Configuração do servidor para se conectar via SSH
>*# nano /etc/ssh/sshd_config*

