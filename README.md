# Simulateur

Simulateur en ligne permettant aux utilisateurs de dimensionner une installation photovoltaïque en fonction de leur toiture et de leur facture d'électricité mensuelle.

Le site propose aux utilisateurs :

- connectés ou non, de pouvoir lancer une simulation et obtenir son résultat
- sans compte, de pouvoir s'inscrire et créer un compte
- avec un compte, de pouvoir se connecter et consulter sa page de compte comportant ses informations et l'historique de ses simulations passées

## Démo

[Video de démo](https://vimeo.com/872310611?share=copy#t=0)

## Pour commencer

- Créer un premier dossier
- A l'intérieur, créer un dossier "app", ouvrir dans le terminal avec un clique droit et cloner le repo ( ``git clone https://github.com/NinaG30/Hpg_symfony.git``)
- Toujours dans le premier dossier, créer un dossier "php" et copier/coller le Dockerfile du projet dedans
- Aussi dans le premier dossier, créer un fichier "nginx" et copier/coller le default.conf
- Dans le premier dossier, copier/coller le docker-compose.yml

### Pré-requis

* Docker - https://www.docker.com/products/docker-desktop/
* Composer (possiblement) - https://getcomposer.org/download/
* Composer - https://getcomposer.org/download/
* Git
* Visual Studio code

### Installation

* Lancer Docker Desktop
* Executer la commande ``docker compose up -d`` en étant dans le dossier qui a le fichier docker-compose.yml pour créer les conteneurs nécessaires
* Lancer Visual Studio code et ouvrir dedans le dossier cloné
* Lancer les conteneurs si ce n'est pas déj fait
* En bas à gauche de visual studio code, cliquer sur la sorte de petit éclair et attacher au conteneur d'execution
* 
* Ouvrir un nouveau terminal
* Dans le dossier app, executer ``docker-compose exec php /bin/bash`` pour entrer dans le conteneur
* Aller dans le dossier comportant le projet (avec la ligne de commande `cd`
* Pour créer la base de données, executer la commande ``php bin/console doctrine:migrations:migrate``

## Démarrage

* Lancer Docker
* Pour voir le site, cliquez sur le port du conteneur nginx

## Fabriqué avec

* Symfony 6.3.5
* PHP 8.2
* Bootstrap 5.3
* CSS3

## Versions

**Dernière version :** 1.0

## Auteurs

* **Nina** _alias_ [@NinaG30](https://github.com/NinaG30)

