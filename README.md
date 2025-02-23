# README

Hippo-pote-ame est une application web qui permet la gestion d'un poney club qui organise divers évenements (cours collectifs, activité de groupes, anniversaires)


## App Info
Une version démo est disponible à cette adresse:  http://93.127.158.210/

Nom d'utilisateur: Demo

Mot de passe: demo

## Installation
L'application a été déveveloppée avec Leaf\mvc : https://leafphp.dev/docs/mvc/

L'application nécessite l'activation des extentions php: gd et ext-inl. Vérifier votre fichier php.ini !

## System dependencies
Outre les paquets utilisés par le framework le paquet dompf\dompdf est requis pour la génération des factures au format pdf

## Configuration
Une base de données mysql ou mariadb est nécessaire pour stocker les données qui sont utilisées dans l'application

## Database creation
Un script de création d'une base de donnée est fourni et se trouve dans storage/app/db

## Deployment instructions

📂 Où cloner le projet avec Git ?

1️⃣ Cloner le projet dans un dossier adapté

cd /var/www

git clone https://github.com/dmosfet/hippo-pote-ame/hippo-pote-ame hippo-pote-ame

cd hippo-pote-ame

Un nom d'utilisateur et un token sera demandé pour la connection au github. N'oubliez pas de générer votre token depuis le Developper Settings de votre compte github

2️⃣ Installer les dépendances Composer

composer install

3️⃣ Définir les permissions correctes

chown -R www-data:www-data /var/www/hippo-pote-ame

chmod -R 755 /var/www/hippo-pote-ame

