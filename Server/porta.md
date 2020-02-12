Como trocar a porta default do SSH no Ubuntu 18.04 Server?

Vamos editar o arquivo de configuração do SSH usando o comando abaixo:
````
# sudo nano /etc/ssh/sshd_config
````

No arquivo sshd_config, localize a configuração #Port 22 (# quer dizer que está comentada). Retire o # e troque o valor 22 por um outro valor da sua escolha, no meu caso coloquei 21022. Salve o arquivo modificado.

Vamos reiniciar o serviço do SSH usando o comando abaixo:
````
# sudo /etc/init.d/ssh restart
````
Como garantir que o serviço SSH está rodando na nova porta? Se você desconectar e a porta não for mais a que você espera, perderá totalmente o acesso ao servidor, sendo assim vamos verificar a configuração por segurança:
````
# netstat -an | grep 21022
````
Teremos o seguinte resultado se tudo estiver bem:
````
tcp        0      0 0.0.0.0:21022       0.0.0.0:*            LISTEN
tcp6      0      0 :::21022                :::*                    LISTEN
````

Veja que a porta está disponível tanto para conexão TCPv4 quanto TCPv6. 

Pronto, agora pode conectar usando a nova porta. Se estiver usando um sistema linux para se conectar ao seu servidor, basta usar o comendo abaixo:
````
# ssh -p 21022 seu-usuario@endereço-do-servidor
````

Não se esqueça que para usar o SCP para cópia de arquivos, o parâmetro de senha é "-P". Eu sempre me esqueço que o parâmetro tem que ser em maiúsculo no comando scp.