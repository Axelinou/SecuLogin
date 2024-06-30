# Nom de ton API

## Prérequis

Avant d'utiliser cette API, assure-toi d'avoir les éléments suivants :

- **WAMP Server** : Un environnement de développement local pour PHP, MySQL et Apache.
- **Base de données MySQL** : Une base de données nommée `login_secu_bdd` pour utiliser avec cette API.


### Structure des dossiers :

- credentials/
    - phpadmin.json
- WWW/
    - SecuLogin/

Dans le dossier `Utilitaires` 
vous trouverez le fichier .json a remplir par vos propres credentials phpmyadmin puis a le placer au bonne endroit (voir Structure des dossiers),
ainsi que le .sql de la base de donnée et ses tables. 

## Utilisation

### Endpoints disponibles :

#### 1. Inscription (`Register`)

Endpoint : `localhost/SecuLogin/Register`

Pour enregister un utilisateur vous aurez besoin de rentrer les infos suivante : 
- Nom d'utilisateur
- Mot de passe


#### 2. Connection (`Connexion`)

Endpoint : `localhost/SecuLogin/Connexion`

Pour vous connecter avec un utilisateur déjà enregister vous aurez a nouveau besoin :
- Nom d'utilisateur
- Mot de passe 

Si l'utilisateur se trompe lors de la tentative de connection plusieurs fois (5 fois) il sera time-out et devra réessayer plus tard
