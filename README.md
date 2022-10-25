# Présentation Général #

Boule de poils est un projet de fin d'études réalisé en automonie par un groupe de 5 étudiants de l'école O'Clock.
Le projet a été réalisé en 4 semaines, chacune représentant un sprint.

- Sprint 1 : Conception en groupe (cahier des charges, user stories, MCD, wireframe, etc...)
- sprint 2 et 3 : Phase de développement (backend et frontend)
- sprint 4 : Débug et de mise en prod.

L'application a pour but de mettre en relation dans une interface simple, les associations et les personnes recherchant un animal de compagnie.
A la façon d’un site de rencontres, les futurs adoptants pourront rechercher grâce à un formulaire la boule de poils qui correspond à leurs besoins.
Pour les associations, elles auront la possibilité de mettre à disposition leurs animaux et ainsi faciliter l’adoption tout en augmentant leur visibilité. Une console d’administration leur permettra de gérer les fiches des animaux et leurs disponibilités.
L’application s’adresse à toutes personnes cherchant à adopter un animal auprès d’une association, mais aussi aux gérants d’associations.

Nous avons présenté le projet en live sur la chaine Youtube de l'école O'Clock le 25/04/2022.
=> A revoir ici : <https://www.youtube.com/watch?v=yBA6xYkmB5s>

Ensuite j'ai présenté ce projet devant un jury de professionnels le 02/06/2022 en vue de l'obtention du Titre Prossionnel de développeur web et web mobile. (TP de niveau V obtenu)

## Liens ##

J'ai hébergé le site sur mon hébergement o2switch.
Le backoffice est accessible ici <https://bdp-admin.julienlaurent.com/> et peut être utilisé avec les identifiants suivants :

- Email : julien@embauchez.moi
- Password : Merci!
  
(Regardez bien, il y a un message subliminal dans l'email &#128521; ).

Le front est accessible ici <https://bouledepoils.julienlaurent.com/>.

PS : L'inscription permet dans une version future de sauvegarder les animaux en favoris. J'ai développé la partie back de cette fonctionnalité mais je n'ai pas encore fait la partie front.

## Présentation technique ##

Nous avons développé un back et un front sur deux applications distinctes connectées par une API REST.

### L'équipe ##

Développeurs Backend :

- Virginie Touzalin
- Julien LAURENT (moi-même)

Développeurs Frontend :

- Mathilde Janssen
- François-Louis Toussaint
- Anthony Mayor

### Backend ###

J'étais en charge avec Virginie de réaliser le backend de l'application, nous avons utilisé Symfony 5.4 et Doctrine pour la gestion de la base de données.
Nous avons développé une console d'administration pour gérer les animaux, les associations et les utilisateurs. Nous avons également développé une API REST pour permettre la communication avec le front et sécurisé les routes avec JWT.
Enfin nous avons mis en place une stratgie de roles pour gérer les droits d'accès.

### Frontend ###

Les autres membres de l'équipe ont réalisé le front de l'application avec React. Le site est entièrement responsive et a été développé avec  Material-UI.
Ils ont développé les différents composants et les ont reliés à l'API REST. On retrouve le formulaire de recherche d'animaux qui affiche ensuite les animaux correspondant à la recherche, un formulaire d'inscription et de connexion et slider qui affiche des animaux alétoire de la base de données.

### Fonctionnalités de l'application ###

- Formulaire de connexion
- Formulaire d’inscription
- Un formulaire de recherche d’animaux avec plusieurs critères dont :
  - Espèce : Chat, Chien, Lapin, Rongeur
  - Genre : femelle, mâle, indifférent
  - Âge : < 1 an, entre 1 et 5 ans, entre 6 et 10 ans, > 10 ans, Indifférent
  - Compatible avec des enfants : oui, non
  - Compatible avec d’autres animaux : oui, non
  - Besoin d’un jardin : oui, non
  - Localisation : sélection d’un département
  - Disponibilité : inclure les animaux en cours de réservation : oui, non
- Visualiser les profils des animaux résultant du formulaire de recherche
- Un « slider » qui affiche aléatoirement des animaux présents sur l’application
- Console d’administration
- Formulaire de connexion
- Contenu adapté au profil connecté
- Gestion des animaux, associations, espèces et utilisateurs. Pour chacun la possibilité de visualiser, ajouter, modifier et supprimer des éléments.
