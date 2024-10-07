Francais

# Application Web Quiz Football - README

## Informations sur le projet

**Nom du projet :** Application Web Quiz Football  
**Développeur :** Ayman Nachid  
**Date de sortie initiale :** 12/12/2023  
**URL de l'application :**  

---

### Aperçu du projet

Cette application web est conçue pour engager les utilisateurs à travers des quiz sur le football et pour gérer des scénarios de quiz comportant plusieurs étapes. Elle inclut des profils d'utilisateurs basés sur des rôles, tels que Administrateurs et Organisateurs, qui peuvent créer et gérer des quiz. Les utilisateurs peuvent également interagir avec les quiz en visualisant les scénarios et en y participant.

L'application est construite en utilisant **Bootstrap** pour un design réactif et une interface utilisateur conviviale. Le template utilisé peut être trouvé à [ce lien]((https://htmlrev.com/free-html-templates.html)).

---

### Fonctionnalités

#### Version 1.1 :
- **Affichage des actualités :** La page d'accueil affiche des actualités et des mises à jour pertinentes sur le football.
- **Accès aux scénarios :** Les utilisateurs peuvent accéder et consulter divers scénarios de quiz et explorer les données de la première étape de chaque scénario.
- **Fonctionnalités de l'administrateur :**
  - Les administrateurs peuvent se connecter, consulter leurs informations, modifier leur mot de passe, et accéder à un tableau récapitulatif des profils utilisateurs.
- **Fonctionnalités de l'organisateur :**
  - Les organisateurs peuvent se connecter, consulter et modifier leur profil, en particulier leur mot de passe.
  - Ils peuvent également consulter un tableau récapitulatif de tous les scénarios de quiz.

#### Version 2 (nommée V1) :
- **Profils utilisateurs :** Ajout d'une nouvelle fonctionnalité pour les profils utilisateurs.
- **Vue détaillée des scénarios :** Les organisateurs peuvent consulter les détails de leurs scénarios de quiz.
- **Gestion des scénarios :** Les organisateurs peuvent créer de nouveaux scénarios, modifier ceux existants, et supprimer des scénarios si nécessaire.
- **Participation des utilisateurs :** Les utilisateurs peuvent désormais participer activement aux scénarios, renforçant ainsi l'aspect interactif de l'application.

---

### Informations sur la base de données

- **Nom de la base de données :**  
- **Procédure de hachage des mots de passe :** Une procédure qui prend un email et un mot de passe en clair en tant que paramètres, sale et hache le mot de passe pour un stockage sécurisé.
- **Triggers :**
  - `generer_sce_code` (avant insertion du scénario) génère une chaîne aléatoire pour le code du nouveau scénario.
  - `sale_hacher_mdp` (après l'insertion du profil) remplace le mot de passe en clair par une version salée et hachée.

### Sécurité et gestion des mots de passe

Les mots de passe sont traités de manière sécurisée dans l'application. Lors de la création d'un compte, le mot de passe saisi est salé et haché via une procédure dans la base de données, garantissant un stockage sécurisé. Les administrateurs et les organisateurs peuvent modifier leur mot de passe via leur page de profil.

---

### Améliorations possibles

- Permettre aux administrateurs et aux organisateurs de gérer le contenu des actualités de football sur la page d'accueil.
- Étendre le processus de création de scénarios pour permettre l'ajout complet de plusieurs étapes, indices, et ressources.
- Ajouter une validation pour les noms d'images téléchargées par les utilisateurs ou les organisateurs.




English

# Football Quiz Web Application - README

## Project Information

**Project Name:** Football Quiz Web Application  
**Developer:** Ayman Nachid  
**Initial Release Date:** 12/12/2023  
**Application URL:**

---

### Project Overview

This web application is designed to engage users in football-related quizzes and manage quiz scenarios with multiple steps. It includes role-based user profiles such as Administrators and Organizers, who can create and manage quizzes. Users can also interact with the quizzes by viewing scenarios and participating in them.

The application is built using **Bootstrap** for its responsive design and user interface. The template used can be found at [this link]((https://htmlrev.com/free-html-templates.html)).

---

### Features

#### Version 1.1:
- **News Display:** The homepage shows relevant football news and updates.
- **Scenario Access:** Users can access and view various quiz scenarios and explore the data from the first step of each scenario.
- **Administrator Features:** 
  - Admins can log in, view their information, modify their password, and access a comprehensive table of user profiles.
- **Organizer Features:** 
  - Organizers can log in, view and modify their profile, particularly their password.
  - They can also view a summary table of all the quiz scenarios.

#### Version 2 (Named V1):
- **User Profiles:** Addition of a new user profile feature.
- **Detailed Scenario View:** Organizers can view detailed information for their quiz scenarios.
- **Scenario Management:** Organizers can create new scenarios, modify existing ones, and delete scenarios if needed.
- **User Participation:** Users can now actively participate in scenarios, enhancing the interactive aspect of the application.

---

### Database Information

- **Database Name:**  
- **Password Hashing Procedure:** A procedure that takes an email and a plain-text password as parameters, salts and hashes the password for secure storage.
- **Triggers:**
  - `generer_sce_code` (before scenario insertion) generates a random string for the new scenario code.
  - `sale_hacher_mdp` (after profile insertion) replaces the plain-text password with a salted and hashed version.


### Security and Password Management

Passwords are securely handled within the application. Upon account creation, the entered password is salted and hashed through a procedure in the database, ensuring secure storage. Administrators and organizers can change their passwords via their profile pages.

---

### Possible Improvements

- Allow administrators and organizers to manage the football news content on the homepage.
- Expand the scenario creation process to allow for the complete addition of multiple steps, hints, and resources.
- Add validation for the names of images uploaded by users or organizers.

