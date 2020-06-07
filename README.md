# Symbnb

Application de type airbnb pouvant servir:
 - aux voyageurs, afin de trouver un bien pour se loger durant leur séjour.
 - aux propriétaires de biens, afin de louer leur appartement ou maison à des voyageurs.
 
Languages de programation utilisé:
  - php
  - javascript
  - twig
  
Framework utilisé: Symfony 5.1.0
Base de donnée: MySQL

INSTALLATION:
- Clonez le projet
- Installez les dépendances avec composer install
- Configurez votre base de donnée dans le fichier .env
- Lancer les migrations en tapant : php bin/console doctrine:migrations:migrate
- Lancez les fixtures en tapant : php bin/console doctrine:fixtures:load
- Lancez le serveur en tapant : php bin/console server:run
