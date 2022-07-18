# TODO #

## Evolution ##

- Mettre en favori un animal - (help : symfo e03 2022 02 18 13-11)
  - Créer une route d'ajout et de suppression avec l'id de l'animal qui envoie en BDD
  - Revoir le MCD pour associer un favori avec un user
- Revoir le SEO
- Recherche par km sur carte
- Commentaire sur l’animal
- Prise de contact entre utilisateur et association depuis l’application.
- Possibilité de créer une alerte si un animal répondant aux critères arrive dans un refuge/association et avoir ces critères enregistrés dans le profil utilisateur.
- Possibilité de gérer plusieurs refuges (si un refuge en possède plusieurs)
- Signaler un contenu inapproprié
- Tags
- Un carrousel affichant des animaux de façon aléatoire
- Refaire le front avec VueJs ou autre.
  - en desktop : affichage des détails sur le coté

## Bugs ##

- Un "user" peut se connecter à la console d'admin (sans accès aux données). Un user qui se connecte doit renvoyer une 403. Gérer la 403 vers une meilleur expérience utilisateur. (try catch ?)
- Si un "admin" se connecte avec un lien accéssible "admin", il a une 403. C'est ok mais il faut gérer la 403 pour une meilleur expérience.
