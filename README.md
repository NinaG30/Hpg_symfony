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
- A l'intérieur, créer un dossier "app", entrer dedans puis ouvrir dans le terminal avec un clique droit et cloner le repo ( ``git clone https://github.com/NinaG30/Hpg_symfony.git``)
- Toujours dans le premier dossier, créer un dossier "php" et copier/coller le Dockerfile du projet dedans
- Aussi dans le premier dossier, créer un fichier "nginx" et copier/coller le default.conf
- Dans le premier dossier, copier/coller le docker-compose.yml

### Pré-requis

* Docker - https://www.docker.com/products/docker-desktop/
* Composer - https://getcomposer.org/download/
* Git
* Visual Studio code

### Installation

* Lancer Docker Desktop
* Dans le premier dossier ou se trouve le fichier "docker-compose.yml", ouvrir dans le terminal avec un clique droit et executer la commande ``docker compose up -d``  pour créer les conteneurs nécessaires
* Executer la commande ``docker-compose exec php /bin/bash`` puis ``cd ../`` puis ``cd hgp_symfony`` puis ``cd Hpg_symfony`` . Normalement vous obtenez quelque chose comme ceci : ``/var/www/hgp_symfony/Hpg_symfony#``
* Executer la commande``php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer`` puis ``composer install``
* Pour créer la base de données, si ce n'est pas déjà le cas, executer la commande ``php bin/console doctrine:migrations:migrate``

## Démarrage

* Pour voir le site, cliquer sur le port du conteneur nginx

## Fabriqué avec

* Symfony 6.3.5
* PHP 8.2
* Bootstrap 5.3
* CSS3

## Versions

**Dernière version :** 1.0

## Auteurs

* **Nina** _alias_ [@NinaG30](https://github.com/NinaG30)

