# Google Cloude
*******
 1. [Instalação SDK](#install-sdk)

*******
<div id='install-sdk'/>

## Instalação SDK

* Verifique se o Python 2.7 está instalado no sistema:
>*python -V*

* Baixar o pacote google-cloud-sdk-231.0.0-linux-x86_64.tar.gz 
* Como alternativa, para fazer o download do arquivo do Linux de 64 bits na linha de comando, execute:
```
$ curl -O https://dl.google.com/dl/cloudsdk/channels/rapid/downloads/google-cloud-sdk-231.0.0-linux-x86_64.tar.gz
```
* Extraia o arquivo em qualquer local no sistema de arquivos, de preferência na pasta raiz:
```
$ tar zxvf nome_do_arquivo google-cloud-sdk
```
* Responder as perguntas:
```
- Você quer ajudar a melhorar o SDK do Google Cloud? (n)
- Você quer continuar? (Y)
- Digite um caminho para um arquivo rc para atualizar ou deixe em branco para usar (Enter)
```
* Execute o seguinte comando:
```
$ gcloud init

Você deve logar para continuar. Gostaria de fazer o login? Y
```
* Execute o comando `gcloud --help` para ver os serviços do Cloud Platform com os quais você pode interagir. E execute o comando `gcloud help COMMAND` para obter ajuda sobre qualquer comando do gcloud.

* Execute o `gcloud topic --help` para aprender sobre os recursos avançados do SDK, como os arquivos arg e a formatação de saída





**[*Fontes*](#)**

* https://cloud.google.com/sdk/
* Linux:<br>
https://cloud.google.com/sdk/docs/quickstart-linux



