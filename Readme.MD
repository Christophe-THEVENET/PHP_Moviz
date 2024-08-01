# Moviz PHP POO MVC

Application de publication et critique de films dans le but de revoir les bases de PHP avec la POO et le MVC. L'administration du site est gérée par un back-office stylisée avec bootstrap.

Testez le formulaire d'ajout/modification de films ou celui d'approbation des commentaires, il y a des fonctionnalités asynchrone.

-   Gestion des utilisateurs sécurisé (login/register/logout)
-   Backoffice sécurisé pour le crud de toutes les données
-   Publication de commentaires
-   Téléchargement d'images
-   Classes boites a outils
-   MVC (Entités, Templates, Controleurs)
-   POO (Encapsulation, Manipulation d'objets, fonctions et attributs de classe)

## Prérequis

-   docker engine

## Installation

```markdown
git clone https://github.com/Christophe-THEVENET/PHP_Moviz.git
```

```markdown
cd PHP_Moviz/
```

#### Créer un fichier .env a la racine de l'appli

-   dans le fichier .env ajouter vos identifiants de connexion a la place de xxxxxxxxx

$$
Pour-MariaDB
$$

```python
MYSQL_ROOT_PASSWORD="root"
MYSQL_DATABASE="moviz_db"
MYSQL_USER="xxxxxx"
MYSQL_PASSWORD="xxxxxxx"
```

$$
Pour-phpMyAdmin
$$

```python
PMA_ARBITRARY=1
PMA_HOST="db"
PMA_USER="xxxxx"
PMA_PASSWORD="xxxxxx"
```

#### Créer les conteneurs docker

```markdown
docker-compose up -d
```

## Utilisation

- Url de phpMyAdmin:
<a href="http://localhost:8899/" target="_blank">http://localhost:8899/</a>

-   Importer a l'aide de phpMyAdmin la base de donnée (fichier moviz_db.sql) fourni dans l'appli.
  

- Url de l'application:
<a href="http://localhost:8080/" target="_blank">http://localhost:8080/</a>

## Ajouter un administrateur

 ### ⚠️ Avertissement
> **Pour accéder au backoffice il faut un utilisateur admin.**


-   créer un utilisateur avec l'application
-   Changer son role (ROLE_ADMIN) dans phpMyAdmin 
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        .great-vibes {
            font-family: 'Great Vibes', cursive;
            font-size : 46px;
            letter-spacing: 6px;
            text-align: center;
            margin-top: 80px;
            color: #758da8;
        }
    </style>
</head>
<body>
    <h1 class="great-vibes">Je vous souhaite une excellente expérience utilisateur !</h1>
</body>
</html>


