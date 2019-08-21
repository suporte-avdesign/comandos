# Firebase Dynamic Links
 
*******
 1. [Instalação](#install)
 2. [Debug](#debug)
 3. [Integração com Laravel](#laravel)
 4. [Ionic](#ionic)
 5. [Videos](#videos)

*******
<div id='install'/>

## Instalação

* Menu -> Dynamic Links -> Primeiros Passos
    * Nome Domínio: projeto.page.link -> Continuar   
    * Clicar em "Novo link dinâmico"
    
* Configurar seu link de URL curto para o android e ios    
    * URL do link direto: `http://url-redirecionamento`
    * Nome do link dinâmico: `Descrção do Link`
    
* Definir o comportamento do link para iOS
    * Abrir o URL do link direto no seu aplicativo para iOS
    * Seleciona o Aplicativo
    ```
    Caso seu aplicativo não esteja instalado, encaminhar o usuário para
    ```
     * Página do seu aplicativo no Play Store
     
* Definir o comportamento do link para Android
    * Abrir o link direto no seu aplicativo para Android
    * Seleciona o Aplicativo
    ```
    Caso seu aplicativo não esteja instalado, encaminhar o usuário para
    ```
    * Página do seu aplicativo no Google Play
    
* Rastreamento de campanhas, tags de redes sociais e opções avançadas (opcional)

* Adicione metatags de redes sociais para compartilhar com mais facilidade.

* No pagelink criado em configuração (...) 
     * Colocar padrão de URL na lista de permissões
     ```
     Exemplo de regras:
     
     ^https://avd-whatsapp.appspot\.com/.*$
     ```

* Digite os seguintes comandos no terminal:
```
ionic cordova plugin add cordova-plugin-firebase-dynamiclinks --save --variable APP_DOMAIN="avd-whatsapp.appspot.com" --variable APP_PATH="/app" --variable PAGE_LINK_DOMAIN="whatsappavd.page.link"

npm install @ionic-native/firebase-dynamic-links@4.14.0 --save
```
* Para remover digite os seguintes comandos:
```
ionic cordova plugin remove cordova-plugin-firebase-dynamiclinks

npm remove @ionic-native/firebase-dynamic-links@4.14.0 --save
```


<div id='debug'/>

## Debug

* Entendendo integração dos links dinâmicos:

* Copiar e visualizar no chorme
  * Se estiver visualizando no browser, será redirecionado para url do link dinâmico
  
* Fazer debug com o link dinâmico:
  * https://linkdinamico.page.link/rniX?d=1
  * https://linkdinamico.page.link?link=https://dominio-https?slug=valor
  * https://linkdinamico.page.link?link=https://dominio-https?slug=valor&d=1
  * https://whatsappavd.page.link/?link=https://avd-whatsapp.appspot.com?slug=valor&apn=br.com.avdesign.whatsapp&ibi=br.com.avdesign.whatsapp&d=1
<div id='laravel'

## Integração com Laravel

* Integração dos links dinâmicos com o Laravel

  `Em Resources/ChatGroupInvitationResource.php`
```
public function toArray($request)
{
  $link = env('MOBILE_PAGE_LINK')
      . '?link='. env('MOBILE_URL'). '/' .$this->slug
      . '&apn='. env('MOBILE_ID')
      . '&ibi='. env('MOBILE_ID');

  $data = [
      'id' => $this->id,
      'total' => (int)$this->total,
      'remaining' => (int)$this->remaining,
      'link' => $link,
      'expires_at' => $this->expires_at,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
  ];
  if (!$this->isCollection) {
      $data['group'] = new ChatGroupResource($this->group);
  }
  return $data;
}
```

<div id='ionic'

## Integração dos links dinâmicos com Ionic

* Adicionar em app.modules.ts
```
import { FirebaseDynamicLinks } from '@ionic-native/firebase-dynamic-links';

providers: [
    --------------------
    FirebaseDynamicLinks
]
```
* Criar providers/chat-invitation/chat-invitation.ts
```
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { LoadingController, ToastController } from 'ionic-angular';
import { FirebaseDynamicLinks, IDynamicLink } from '@ionic-native/firebase-dynamic-links';
import { environment } from '@app/env';
import { AuthProvider } from '../auth/auth';


const CHAT_GROUP_INVITATION_SLUG = 'chat_group_invitation_slug';


/*
  Generated class for the ChatInvitationProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ChatInvitationProvider {

  constructor(public fbDynamicLinks: FirebaseDynamicLinks, 
              private http: HttpClient,
              private loadingCtrl: LoadingController,
              private toastCtrl: ToastController,
              private auth: AuthProvider) {
    console.log('model: firebase-dynamic-links');
  }

  listen(){
    this.fbDynamicLinks
        .onDynamicLink()
        .subscribe((res: IDynamicLink) => {
          this.saveInStorage(res.deepLink);
          this.requestInvitationIfAuth();
        });
  }

  private requestInvitationIfAuth(){
    this.auth.isAuth()
        .then(isAuth => {
          if(isAuth){
            this.requestInvitation();
          }
        });
  }


  public requestInvitation(){
    if (!this.slug) {
      return;
    }

    const loader = this.loadingCtrl.create({
      content: 'Ingressando no grupo...'
    });
    loader.present();
    const slug = this.slug;
    this.slug = null;
    this.http.post(`${environment.api.url}/chat_invitations/${slug}`, {})
        .subscribe(() => {
          loader.dismiss();
          const toast = this.toastCtrl.create({
            message: 'Inscrição aceita, aguarde o administrador aprovar seu convite.',
            duration: 5000
          })
          toast.present();

        }, (error) => {
          loader.dismiss();
          let message = 'Não foi possível ingresar no grupo.';
          if (error.status == 403 || error.status == 422) {
            message = error.error.message;
          }
          const toast = this.toastCtrl.create({
            message,
            duration: 5000
          })
          toast.present();

        });
  }

  private saveInStorage(deepLink: string){
    this.slug = this.getInvitationSlugFromLink(deepLink);
  }

  private get slug(){
    return window.localStorage.getItem(CHAT_GROUP_INVITATION_SLUG);
  }


  private set slug(value){
    value ? window.localStorage.setItem(CHAT_GROUP_INVITATION_SLUG, value) : 
            window.localStorage.removeItem(CHAT_GROUP_INVITATION_SLUG)
  }

  private getInvitationSlugFromLink(deepLink: string){
    const deepLinkFirstPart = deepLink.split('&')[0];
    return deepLinkFirstPart.substring(deepLinkFirstPart.lastIndexOf('/')+1, deepLinkFirstPart.length);
    //Obs: habilitar resource para IOS
    //https://lavdesign.page.link/?link=https://code.education/group/bSOZJOx&apn=br.com.avdesign.whatsapp&ibi=br.com.avdesign.whatsapp
  }

}

```

<div id='videos'/>
  
## Videos

**CONVITES DE GRUPO**
* Introdução aos links dinâmicos do Firebase
    * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=632&conteudo=5541    
* Entendendo integração dos links dinâmicos com a...
    * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=632&conteudo=5540    
* Integração dos links dinâmicos com o Laravel
    * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=632&conteudo=5539
* Integração dos links dinâmicos com Ionic
    * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=632&conteudo=5538
* Extraindo slug do link dinâmico
    * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=632&conteudo=5537
* Definindo de requisição de entrada em grupos
    * https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=632&conteudo=5536