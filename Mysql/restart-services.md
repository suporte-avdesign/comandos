##Verificador de serviços


Bash Script para verificar se os serviços estão em execução e reinicie se não estiver. Envia e-mail para você. Testado com o Ubuntu 14.04, 16.04 e 18.04.

##Instalação

1- coloque na sua pasta de scripts
2- defina seu endereço de e-mail
3- definir os serviços que você deseja manter um olho (por padrão, ele tem mysql e apache2 .. você pode adicionar ou tirar o que for necessário)
salve suas alterações
4- crie um cronjob como root (sudo crontab -e) e adicione algo como isso, que é executado a cada minuto (ajuste às suas necessidades):

```
#check on services
*/1 *  * * * /your/path/to/scripts/restart-services
```

O script verificará o status de cada serviço. Se o serviço for interrompido, ele tentará reiniciar o serviço. Se o serviço iniciar, ele enviará um e-mail informando que o serviço foi interrompido, mas foi reiniciado.

Se o serviço não for iniciado por algum motivo, ele enviará um e-mail informando que ele não foi iniciado.

Depois disso, ele continuará a tentar e iniciar, mas não enviará mais e-mails até que o serviço seja finalmente iniciado.