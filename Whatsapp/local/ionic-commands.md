# Comandos Basicos
* Endereço do ip do WiFi linux: ifconfig 
```
php artisan serve --host=192.168.0.1
```
$ Desabilitar o firewall do Ubuntu:  
>*$ sudo iptables -F*

* Caso sua conexão esteja lenta adicionar no arquivo config.xml 
```
<preference name="loadUrlTimeoutValue" value="700000" />
```
* Limpar o cache do cordova
```
cordova clean
```

* Instalar Plataformas
```
ionic cordova platform add android --save
ionic cordova platform add ios --save
ionic cordova platform add windows --save
```
* Remover Plataformas
```
ionic cordova platform remove android
ionic cordova platform rm android
```
* Gerando Builds
```
ionic cordova build android
ionic cordova build ios
ionic cordova build windows
```
* Simular aplicação no emulador
```
ionic cordova emulate android
ionic cordova emulate ios
ionic cordova emulate windows
```
* Simular aplicação no dispositivo
```
ionic cordova run android --device --livereload
ionic cordova run ios --device --livereload
ionic cordova run windows --device --livereload
```
* Testando em 2 emuladores
```
adb devices
ionic cordova run android --target=xpto
```
* Debugando no Chrome digite:
```
chrome://inspect
```
