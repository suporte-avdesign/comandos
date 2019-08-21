# Firebase Realtime Database 
*******
 1. [Instalação](#install)

*******
<div id='install'/>

## Instalação<br>

* Menu -> database -> Realtime Database -> Dados
```
roles
    CUSTOMER: 1
    SELLER: 2
```

* Regras (exemplo)
```
{
  "rules": {
    "chat_groups": {      
      ".read": "auth.uid !== null"
   	},
    "chat_groups_messages": {
      "$group_id": {        
        ".read": "root.child('chat_groups_users').child($group_id).child(auth.uid).exists() || root.child('users').child(auth.uid).child('role').val() === root.child('roles').child('SELLER').val()"      		
      }
    },
    "chat_groups_users": {
      "$group_id": {        
        "$user_id": {
          ".read": "auth.uid === $user_id" 
        }       		
      }
    },   
   	"users": {      
      "$user_id": {
        ".read": "auth.uid !== null"    		
      }
    } 
  }
}
```

**[*Fontes*](#)**

* https://portal.code.education/lms/#/164/147/90/conteudos?capitulo=635&conteudo=5612

