## Google Cloud Deploy
*******
 1. [Importante](#gcloudignore)

*******
<div id='gcloudignore'/>

## Importante

* Criar arquivo .gcloudignore
 https://cloud.google.com/sdk/gcloud/reference/topic/gcloudignore

```
node_modules/
public/storage/
storage/*.key
vendor/
.idea/
.git/
.env
app.yaml
.phpstorm.meta.php
_ide_helper.php
_ide_helper_models.php
```
* Criar o arquivo `app.yaml`  e como exemplo `app.yaml.exemple`

```

runtime: php
env: flex

runtime_config:
  document_root: public

env_variables:
  APP_NAME: AvdWhatsapp
  APP_ENV: prod
  # php artisan key:generate --show
  APP_KEY: base64:qavTq+XdoU3LZHLx13ldGoI07ImO4h45R0tL+ISBMXU=
  APP_DEBUG: true
  LOG_CHANNEL: errorlog
  # php artisan jwt:secret --show
  JWT_SECRET: E6Sg2foOi17wd5zoQ1KVssCwxqOZkn4u
  JWT_BLACKLIST_GRACE_PERIOD: 30
  FB_SERVER_KEY: AAAAgVTeFxM:APA91bFgsNNCAQZmMFF_LW8V82Ub8dGdbS26VS2yCX5cePUeaXAzBpc8LRfAPl6Z2CZUshtS5ukooz6nB6y3_VAhIbxRVBy0qRHBSco8TiTQoYFJt7glb5LyiZQQPDZ28ygJo4Ivya8Z
  MOBILE_URL: https://code.education/group
  MOBILE_PAGE_LINK: https://lavdesign.page.link
  MOBILE_ID: br.com.avdesign.whatsapp
  # Banco de Dados
  DB_HOST: localhost
  DB_DATABASE: avd_whatsapp
  DB_USERNAME: root
  DB_PASSWORD: avdesign123
  DB_SOCKET: "/cloudsql/avd-whatsapp:us-central1:whatsappbdsql"
  # Cache e Session
  CACHE_DRIVER: database
  SESSION_DRIVER: database
  # Servidor de Emais
  MAIL_DRIVER: smtp
  MAIL_HOST: smtp.mailtrap.io
  MAIL_PORT: 2525
  MAIL_USERNAME: cc392f66131004
  MAIL_PASSWORD: 51956cb6221fe0
  MAIL_ENCRYPTION: null
  # Path products
  BASE_PRODUCTS_URL: "https://avd-whatsapp.appspot.com/storage/products/"
  # Informações do cloud
  GOOGLE_CLOUD_PROJECT_ID: avd-whatsapp
  GOOGLE_CLOUD_KEY_FILE: "./cloud-chave-bd.json"
  GOOGLE_CLOUD_STORAGE_BUCKET: "avd-whatsapp.appspot.com"
  GOOGLE_CLOUD_STORAGE_API_URI: "https://storage.cloud.google.com/avd-whatsapp.appspot.com"

beta_settings:
    cloud_sql_instances: "avd-whatsapp:us-central1:whatsappbds
    
```

* Comando para o deploy
>*$ gcloud app deploy*
* Escolher a opção da região [10]
* Aceesar via terminal 
>*$ gcloud app browse*
* Erros pelo terminal
>*$ gcloud app logs tail -s default*


* Referência do app.yaml
https://cloud.google.com/appengine/docs/standard/python/config/appref#example


