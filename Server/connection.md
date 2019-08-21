## Conexão com o servidor
*******
 1. [Aumentar Memória (opcional)](#swap)

 2. [Integração do aplicação com banco de dados](#virtual-host)

*******
<div id='virtual-host'/>

## Integração do aplicação com banco de dados
```
../../cloud_sql_proxy -instances="avd-whatsapp:us-central1:whatsappbdsql"=tcp:3307 -credential_file=cloud-chave-bd.json

```

* Integração do aplicação com banco de dados
    * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=635&conteudo=5617