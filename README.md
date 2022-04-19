# Installation de Symfony #

Vous avez cloné ce repo avec succès, c'est un bon début ;)
Pour continuer l'installation suivez les étapes ci-dessous :

## -> Si vous avez déja une BDD ##

Il est préférable de supprimer la database bouledepoils manuelement dans Adminer avant de faire l'installation.
C'est temporaire le temps que certains champs soit définitivement validés.

## Composer et dépendances ##

Warning - Passer sur la branche develop

Faire un composer install dans le terminal pour installer le dossier vendors et les dépendances du projet

```sh
composer install
```

## Connexion à la BDD ##

A la racine du projet créer un fichier .env.local (il devrait apparaitre en dessous du .env existant). Ensuite copier/coller la ligne suivante dans ce .env.local :
```DATABASE_URL="mysql://username:password@127.0.0.1:3306/bouledepoils?serverVersion=MariaDB-10.3.32&charset=utf8mb4"``` Remplacer username et password par explorateur et son mot de passe.

Puis lancer la commande suivante dans le terminal pour créer la BDD "bouledepoils" dans votre MySql

```sh
bin/console doctrine:database:create
```

Ensuite vous allez toutes les tables et relations :

```sh
bin/console doctrine:migration:migrate
```

## Ajouter les données à la BDD ##

On va ajouter des données fictives pour pouvoir travailler, ce sont les fixtures.

```sh
bin/console doctrine:fixtures:load
```

## Serveur web ##

```php -S localhost:8081 -t public```

C'est maintenant prêt, good luck :)


## Si besoin de supprimer la BDD ##

```bin/console doctrine:database:drop --force```
