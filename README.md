## Pages

- Accueil

- Liste des livres
- Creation d'un livre *
- Details d'un livre
- Modification d'un livre *
- Suppression d'un livre *

- Liste des auteurs
- Creation d'un auteur *
- Details d'un auteur
- Modification d'un auteur *
- Suppression d'un auteur *

- Creation d'un compte utilisateur (register)
- Connexion (login)
- Déconnexion (logout)

- Mon profil *
- Modification du profil


* Pages sécurisés



## Routes (path)

- /                     Homepage

- /books                 INDEX
- /book                  CREATE
- /book/{id}             READ
- /book/{id}/edit        UPDATE
- /book/{id}/delete      DELETE

- /authors                 INDEX
- /author                  CREATE
- /author/{id}             READ
- /author/{id}/edit        UPDATE
- /author/{id}/delete      DELETE

- /register             Creation du compte utilisateur
- /login                Connexion
- /logout               Déconnexion

- /profile              Profil utilisateur
- /profile/edit         Modification du Profil utilisateur
- /profile/delete       Suppression du Profil utilisateur


## Controllers

- HomepageController::index()

- BookController::index()
- BookController::create()
- BookController::read()
- BookController::update()
- BookController::delete()

- AuthorController::index()
- AuthorController::create()
- AuthorController::read()
- AuthorController::update()
- AuthorController::delete()

- RegisterController::index() **

- SecurityController::login() **
- SecurityController::logout() **

- ProfileController::index()
- ProfileController::update()
- ProfileController::delete()

** Controllers générés par Symfony


## Entités

- Book          bin/console make:entity Book
- Author        bin/console make:entity Author
- User          bin/console make:xxxxxxxxxxxx