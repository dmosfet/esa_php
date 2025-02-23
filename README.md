# README

Hippo-pote-ame est une application web qui permet la gestion d'un poney club qui organise divers évenements appelées sessions (cours collectifs, activité de groupes, anniversaires). Les activités de groupes sont organisés à la demande d'associations/d'entreprise. Les cours collectifs sont ouvert à tous particuliers qui sont enregistrés en tant que clients. Les anniversaires peuvent être organisés aussi bien pour les particuliers que pour les entreprises. L'application permet outre ces sessions, de gérer des poneys, des clients, et des factures. 

L'application fonctionne avec des rôles qui limitent les accès à l'application. Cette gestion des rôles est prise en charge par le modul Leaf\Auth du framework Leaf\MVC qui a été développé pour celle-ci.Les utilisateurs sont créés par défaut en tant que guest. Ils doivent ensuite demander à l'utilisateur admin une augmentation des droits via leur menu personnel.

Les facturations sont gérées par période de facturation qui est composée d'un mois et d'une année. Elle reprend toutes les sessions pour la période du client. Elles peuvent être générées pour tous les clients ou un client en particulier.

L'application permet aussi de visualiser le temps de travail des poneys pour la semaine en cours (heures réalisées et planifiées). Cette charge de travail est exprimée en pourcentage en fonction du temps de travail maximum précisé pour chaque poney.
Pour chaque poney, on peut également encoder un suivi medical.



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

