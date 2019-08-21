# Instalação e configuração do Ionic
*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação
>*$ npm install*

* Criar arquivo export default na raiz com as credencias do arquivo.js
```
export default{ 
    apiKey: "---",
    authDomain: "---",
    databaseURL: "---",
    projectId: "---",
    storageBucket: "---",
    messagingSenderId: "---"
}
```
* Alterar as urls em environment.js
* Alterar as urls permitidas JWT app.modules.ts
```
function jwtFactory(authService: AuthProvider) {
  return {
      whitelistedDomains: [
        //new RegExp('192.168.0.106:8000/*'),
        new RegExp('192.168.0.102:8000/*')

      ],
      tokenGetter: () => {
        return authService.getToken();
      }
  }
}
```


