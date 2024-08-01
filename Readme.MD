# Moviz PHP POO MVC   
Révision des bases de PHP avec la POO et le MVC.
Application de critique de films. L'administration du site est gérée par un back-office stylisée avec bootstrap.

Testez le formulaire d'ajout/modification de film  ou celui d'approbation des commentaires, il y a des fonctionnalités asynchrone.

- gestion des utilisateurs (login/register/logout)
- publication de commentaires
- crud des films
- crud des réalisateurs
- crud des utilisateurs
- téléchargement d'images
- backoffice sécurisé pour le crud de toutes les données

## Prérequis

* docker engine
  
## Installation


```markdown
git clone https://github.com/Christophe-THEVENET/PHP_TechTrendz.git
```

```markdown
cd PHP_TechTrendz/
```

#### Créer un fichier .env a la racine de l'appli
- dans le fichier .env ajouter vos identifiants de connexion a la place de xxxxxxxxx

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


url de phpMyAdmin:
<a href="http://localhost:8899/" target="_blank">http://localhost:8899/</a>



- importer a l'aide de phpMyAdmin la base de donnée (fichier techtrendz_db.sql) fourni dans 'appli.

url de l'application:
<a href="http://localhost:8080/" target="_blank">http://localhost:8080/</a>


## Ajouter un administrateur

* créer un utilisateur en selectionnant le rôle admin
