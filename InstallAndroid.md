# Instalação do Android Studio

*******
Instalação dos Ambientes:

 1. [Variaveis de Ambiente](#variaveis-ambiente)
*******

<div id='variaveis-ambiente'/>

## Ubuntu <br>
Digite os seguintes comandos:

>*sudo nano ~/.bashhrc*

Digite os phats abaixo:

export JAVA_HOME="/usr/lib/jvm/java-8-oracle"
PATH=$PATH:$JAVA_HOME/bin

export ANDROID_HOME="$HOME/Android/Sdk"
PATH=$PATH:$ANDROID_HOME/tools

>*sudo nano /etc/profile*

Digite o path abaixo:

export GRADLE_HOME=/opt/gradle/gradle-4.6
export PATH="$PATH":"$GRADLE_HOME/bin"

