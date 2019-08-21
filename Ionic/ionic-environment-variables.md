## Variáveis ​​de ambiente fáceis de usar para o Ionic
*******
 1. [Install](#install)

*******

<div id='install'/>

## Install


* Crie um arquivo em seu diretório base config/webpack.config.jse cole o seguinte:

var chalk = require("chalk");
var fs = require('fs');
var path = require('path');
var useDefaultConfig = require('@ionic/app-scripts/config/webpack.config.js');

var env = process.env.IONIC_ENV;

useDefaultConfig.prod.resolve.alias = {
  "@app/env": path.resolve(environmentPath('prod'))
};

useDefaultConfig.dev.resolve.alias = {
  "@app/env": path.resolve(environmentPath('dev'))
};

if (env !== 'prod' && env !== 'dev') {
  // Default to dev config
  useDefaultConfig[env] = useDefaultConfig.dev;
  useDefaultConfig[env].resolve.alias = {
    "@app/env": path.resolve(environmentPath(env))
  };
}

function environmentPath(env) {
  var filePath = './src/environments/environment' + (env === 'dev' ? '' : '.' + env) + '.ts';
  if (!fs.existsSync(filePath)) {
    console.log(chalk.red('\n' + filePath + ' does not exist!'));
  } else {
    return filePath;
  }
}

module.exports = function () {
  return useDefaultConfig;
};

* Acresentar em package.json as seguintes linhas
```
"scripts": {    
    "env": "node generate-env.js"
},
"config": {
"ionic_webpack": "./config/webpack.config.js"
},
```
* Acresentar em tsconfig.json as seguintes linhas
```

"baseUrl": "./src",
"paths": {
   "@app/env": [
     "environments/environment"
   ]
}
```
* Criar arquivos environment.ts e (dev,prod)
```
export const environment = {
  production: true,
  api: {
    protocol: 'http',
    host: '192.168.0.102:8000',
    get url(){
      return `${this.protocol}://${this.host}/api`;
    }
  },
  //baseFilesUrl: `http://192.168.0.106:8000/storage`,
  baseFilesUrl: `http://192.168.0.102:8000/storage`,
  //showFirebaseUI: !document.URL.startsWith('file:///')
  showFirebaseUI: false
};
```

**GITHUB**
* https://github.com/gshigeto/ionic-environment-variables
    
**VIDEO**   
* https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=626&conteudo=5429