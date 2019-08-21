## Métodos usados
*******
 1. [onAuthStateChanged (userInfo) retorna vazio](#teste1)
 2. [signInWithVerificationId (userInfo) retorna correto](#teste2)
 2. [signInAndRetrieveDataWithCredential (user) retorna vazio](#teste3)


*******
<div id='onAuthStateChanged'/>

* Com o método onAuthStateChanged (userInfo) retorna vazio, como o próprio Fabiano postou.
````
import { Component, EventEmitter, Output } from '@angular/core';
import { Platform, ToastController, AlertController } from 'ionic-angular';
import { FirebaseAuthProvider } from '../../providers/auth/firebase-auth';

@Component({
  selector: 'firebase-phone-number-check',
  templateUrl: 'firebase-phone-number-check.html'
})
export class FirebasePhoneNumberCheckComponent {

    countryCode = "55";
    phoneNumber = '';
    verificationId = "";
    smsCode = '';
  
    @Output() onAuth: EventEmitter<any> = new EventEmitter<any>();
  
  
    constructor(private platform: Platform,
                private toastCtrl: ToastController,
                private alert: AlertController,
                private firebaseAuth: FirebaseAuthProvider) {
      console.log('Hello FirebasePhoneCheckComponent Component');
    }
  
    resendSmsCode(){
        this.verifyPhoneNumber()
            .then(() => this.showToast('SMS enviado.'))
    }
  
    verifyPhoneNumber(): Promise<any> {
      return new Promise((resolve, reject) => {
  
          this.platform.ready().then(()=> {
              cordova.plugins.firebase.auth.verifyPhoneNumber(this.fullPhoneNumber, 0)
                  .then(
                      verificationId => {
                          resolve(this.verificationId = verificationId)
                      },
                      error => {
                          console.log(error);
                          reject(error);
                          this.showToast(error)
                      }
                  )
          })
  
      })
        .then((verification) => console.log('código e verificao foi recebido.'))
    }
  
    signInWithVerificationId(){
  
        cordova.plugins.firebase.auth.onAuthStateChanged((userInfo) =>{
            this.showToast(userInfo);
            if (userInfo && userInfo.uid) {
                console.log('userInfo from Cordova',userInfo);
                this.showToast(userInfo);
                const fbCredential = this.firebaseAuth.firebase.auth.PhoneAuthProvider.credential(this.verificationId, this.smsCode)
                this.firebaseAuth.firebase.auth()
                    .signInAndRetrieveDataWithCredential(fbCredential)
                    .then(
                        (user) => {
                            this.showToast('User authenticated');
                            console.log('User authenticated',user);
                            this.onAuth.emit(user);
                        },
                        (error) => {
                            console.log('User not authenticated',error);
                            let alert = this.alert.create({
                              title: 'error',
                              message: error,
                              buttons: ['OK']
                            });
                            alert.present();
                        }
                    );
            } else {
                this.showToast(userInfo);
                this.showToast('user was signed out');
            }
        });
  
    }
  
    get fbCredential(){
        return this.firebaseAuth
            .firebase
            .auth
            .PhoneAuthProvider
            .credential(this.verificationId, this.smsCode)
    }
  
    showToast(message){
      const toast = this.toastCtrl.create({
          message,
          duration: 3000
      });
      toast.present();
    }
  
    cancel(){
        this.verificationId = '';
    }
  
    get fullPhoneNumber(){
        const countryCode =  this.countryCode.replace(/[^0-9]/g, '');
        return `+${countryCode}${this.phoneNumber}`;
    }

}

````

<div id='signInWithVerificationId'/>

* Com o método signInWithVerificationId (userInfo) retorna correto:
````
{
    uid: "o3Xqzti75Jxxxxxxxxxxxx", 
    phoneNumber: "+551196938xxxx", 
    providerId: "firebase"
}
````
<div id='signInAndRetrieveDataWithCredential'/>

* O método signInAndRetrieveDataWithCredential(this.fbCredential) (user) retorna vazio
    * Retorna: Não foi possível autenticar o telefone.
````
{
    code: "auth/code-expired", 
    message: "The SMS code has expired. Please re-send the verification code to try again."
}
````

* firebase-phone-number-check.ts
````
import { Component, EventEmitter, Output } from '@angular/core';
import { Platform, ToastController } from 'ionic-angular';
import { FirebaseAuthProvider } from '../../providers/auth/firebase-auth';

declare const cordova;

@Component({
  selector: 'firebase-phone-number-check',
  templateUrl: 'firebase-phone-number-check.html'
})
export class FirebasePhoneNumberCheckComponent {

    countryCode: string = "55";    
    phoneNumber: string = "";
    verificationId: any = "";
    smsCode: string = "";  

    @Output()
    onAuth: EventEmitter<any> = new EventEmitter<any>();

    constructor(private platform: Platform,
                private toastCtrl: ToastController,
                private firebaseAuth: FirebaseAuthProvider) { 
    }


    resendSmSCode() {
        this.verifyPhoneNumber()
            .then(() => this.showToast('SMS enviado'));
    }


    verifyPhoneNumber(): Promise<any> {


        return new Promise((resolve, reject) => {
            this.platform.ready().then(() => {
                cordova.plugins.firebase.auth.verifyPhoneNumber(this.fullPhoneNumber, 0)
                    .then(
                        verificationId => resolve(this.verificationId = verificationId
                    ),  error => {
                            alert(error);
                            //console.log(error);
                            reject(error);
                            this.showToast('Não foi possível verificar o telefone');
                        }
                    )
            })
        }).then((verification) => {            
            console.log('Code verification: Ok');
        });
    }
  

    cancel(){
        this.verificationId = '';
    }


    get fullPhoneNumber(){
        const countryCode = this.countryCode.replace(/[^0-9]/g, '');
        return `+${countryCode}${this.phoneNumber}`;
    }    


    signInWithVerificationId() {

        cordova.plugins.firebase.auth
            .signInWithVerificationId(this.verificationId, this.smsCode)
            .then((userInfo) => {
                console.log(userInfo);
                this.firebaseAuth.firebase.auth().signInAndRetrieveDataWithCredential(this.fbCredential)
                .then((user) => {
                    console.log(user)
                    this.onAuth.emit(user)
                }, (error) => {
                    this.showToast('Não foi possível autenticar o telefone.');
                    console.log(error);
                }
            )

        }, (error) => {
            this.showToast('Não foi possível verificar o código SMS.');
            console.log(error);
        });

    }


    get fbCredential() {
        return this.firebaseAuth
            .firebase
            .auth
            .PhoneAuthProvider
            .credential(this.verificationId, this.smsCode);
    }


    showToast(message){
        const toast = this.toastCtrl.create({
            message,
            duration: 3000
        });
        toast.present();
    }

}

````