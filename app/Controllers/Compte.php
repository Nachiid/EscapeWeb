<?php

namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Compte extends BaseController
{
    private $model;
    //constructeur pour declarer le formulaire et instancié le model
    public function __construct()
    {
        helper('form');
        $this->model = model(Db_model::class);
    }

    //Fonction pour lister les comptes pour un adm
    public function lister()
    {
        $session = session();

        if($this->model->afficher_role($session->get('user')) == 'A'){

        $data['titre'] = "Liste de tous les comptes";
        $data['logins'] = $this->model->get_all_compte();
        return view('templates/haut')
            .view('menu_administrateur',$data)
            . view('connexion/comptes_affichage')
            . view('templates/bas');
        }else{
            return redirect()->to(route_to('/'))->with('error', 'Vous n\'etes pas un administrateur.');
        }
    }


    //Fonction pour creer un compte pour un adm
    public function creer()
    {
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod() == "post") {
            if (!$this->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'pseudo' => 'required|max_length[255]|is_unique[T_compte_cpt.cpt_email]|min_length[2]',
                'mdp' => 'required|min_length[12]',
                'conf_mdp' => 'required|matches[mdp]'
            ],
            [
                'nom' => [
                    'required' => 'Veuillez entrer votre nom.'
                ],
                'prenom' => [
                    'required' => 'Veuillez entrer votre prénom.'
                ],
                'pseudo' => [
                    'required' => 'Veuillez entrer un pseudo pour le compte.',
                    'is_unique' => 'Le pseudo existe déjà, veuillez en choisir un autre.',
                    'min_length' => 'Le pseudo saisi est trop court (minimum 2 caractères).'
                ],
                'mdp' => [
                    'required' => 'Veuillez entrer un mot de passe.',
                    'min_length' => 'Le mot de passe doit contenir au moins 12 caractères.'
                ],
                'conf_mdp' => [
                    'required' => 'Veuillez confirmer le mot de passe.',
                    'matches' => 'La confirmation du mot de passe ne correspond pas au mot de passe saisi.'
                ]
            ])) {
                // La validation du formulaire a échoué, retour au formulaire !
                return redirect()->to(route_to('compte/creer'))->withInput()->with('error', 'Erreur dans le formulaire.');
            }

            $recuperation = $this->validator->getValidated();
            $role = $this->request->getPost('role');
            $etat = $this->request->getPost('etat');
            if ($role == 'adm'){
                $role = 'A';
            }else {
                $role = 'O';
            }
            if ($etat == 'act'){
                $etat = '1';
            }else {
                $etat = '0';
            }
            $this->model->set_compte($recuperation,$role,$etat);
            if (!$this->model) {
                
                return 
                view('templates/haut')
                .view('menu_administrateur', ['titre' => 'erreur'])
                    . view('compte/compte_creer')
                    . view('templates/bas');
            }

            $data['le_compte'] = $recuperation['pseudo'];
            $data['le_message'] = "Nouveau nombre de comptes : ";
            $data['le_total'] = $this->model->get_nb_comptes();

            return redirect()->to(route_to('compte/lister'))->with('success', 'Compte creer !.');
        }

        // L’utilisateur veut afficher le formulaire pour créer un compte
        return  view('templates/haut') 
        .view('menu_administrateur', ['titre' => 'Créer un compte'])
            . view('compte/compte_creer')
            . view('templates/bas');
    }

    //Fonction pour se connecter a  un compte adm/orga
    public function connecter()
    {
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod() == "post") {
            if (!$this->validate([
                'pseudo' => 'required',
                'mdp' => 'required'
            ])) {
                // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut')
                    . view('menu_visiteur', ['titre' => 'Se connecter'])
                    . view('connexion/compte_connecter')
                    . view('templates/bas');
            }
    
            // La validation du formulaire a réussi, traitement du formulaire
            $username = $this->request->getVar('pseudo');
            $password_temp = $this->request->getVar('mdp');
    
            // Mot de passe salé haché
            $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
            $password = hash('sha256', $salt . $password_temp);
    
            if ($this->model->connect_compte($username, $password) == true) {
                $session = session();
                $session->set('user', $username);
                $Role = $this->model->afficher_role($session->get('user'));
                if ($Role == 'A') {
                    return view('templates/haut') //adm
                        . view('menu_administrateur')
                        . view('connexion/compte_accueil')
                        . view('templates/bas');
                } else {
                    return view('templates/haut') //org
                        . view('menu_organisateur')
                        . view('connexion/compte_accueil')
                        . view('templates/bas');
                }
            } else {
                // Afficher une erreur de connexion
                return redirect()->to(route_to('compte/connecter'))->withInput()->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');

            }
        }
    
        // L’utilisateur veut afficher le formulaire pour se connecter
        return view('templates/haut')
            . view('menu_visiteur', ['titre' => 'Se connecter'])
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }
    
    //fonction pour afficher un profil
    public function afficher_profil()
    {
       $session = session();
       if ($session->has('user')) {
          $data['titre'] = "Information du profil";
          $data['profil'] = $this->model->afficher_profil($session->get('user'));
          $userRole = $this->model->afficher_role($session->get('user'));
          if ($userRole === 'A') {
             return view('templates/haut')
                . view('menu_administrateur', $data)
                . view('connexion/compte_profil')
                . view('templates/bas');
          } else {
             return view('templates/haut')
                . view('menu_organisateur', $data)
                . view('connexion/compte_profil')
                . view('templates/bas');
          }
       } else {
          return redirect()->to(route_to('accueil/afficher'));
       }
    }

    //Fonction pour modification et redirection
    public function modifier_mot_de_passe()
    {
        $session = session();
        // Vérifie si l'utilisateur est connecté
        if (!$session->has('user')) 
        {
            return redirect()->to(route_to('accueil/afficher'));
        }

        // Vérifie si le formulaire a été soumis
        if ($this->request->getMethod() == "post") 
        {
            $validationRules = [
                'mdp' => 'required|max_length[255]|min_length[8]',
                'conf_mdp' => 'required|matches[mdp]'
            ];

            if (!$this->validate($validationRules)) 
            {
                // La validation du formulaire a échoué, retour au formulaire avec les erreurs
                return redirect()->to(route_to('compte/afficher_profil'))->withInput()->with('error', 'Veuillez corriger les erreurs.');
            }

            $nouveau_mdp = $this->request->getPost('mdp');

            // Appelez votre fonction pour changer le mot de passe dans le modèle
            $result = $this->model->modifier_mdp($session->get('user'), $nouveau_mdp);

            if ($result) {
                // Redirigez avec un message de succès
                return redirect()->to(route_to('compte/afficher_profil'))->with('success', 'Mot de passe changé avec succès.');
            } else {
                // Redirigez avec un message d'erreur
                return redirect()->to(route_to('compte/afficher_profil'))->withInput()->with('error', 'Erreur lors du changement de mot de passe.');
            }
        }

        // Si le formulaire n'a pas été soumis, redirigez vers la page d'origine
        return redirect()->to(route_to('compte/afficher_profil'));
    }

    //Fonction pour changer l'etat d'un profil pas demandé = pas utiliser (code en commentaire si jamais)
    public function changer_etat_profil()
    {
        if ($this->request->getMethod() == "post") 
        {
            $cpt_email = $this->request->getPost('etat');
            $result = $this->model->changer_etat_profil($cpt_email);
            if ($result) 
            {
                // Redirigez avec un message de succès
                return redirect()->to(route_to('compte/lister'))->with('success', 'Etat du profil changé.');
            } else {
            // Redirigez avec un message d'erreur
            return redirect()->to(route_to('compte/lister'))->with('error', 'Erreur lors du changement.');
            }
        }
    }

    //Fonction pour visualisé les données d'un scenario
    public function listeretapes()
    {
        $session = session();
        if ($session->has('user')){
            if($this->model->afficher_role($session->get('user')) == 'O'){
                if ($this->request->getMethod() == "post") {
                    $sce_id = $this->request->getPost('sce_id');
                    $etape = $this->model->get_all_etape($sce_id); 
                    $info_sce =  $this->model->get_scenario($sce_id);  
                    $data['titre1'] = "Scenario courant";
                    $data['titre2'] = "Details des etapes du scenario ";
                    $data['etapes'] = $etape;
                    $data['scenario'] = $info_sce;
                    return view('templates/haut')
                    . view('menu_organisateur', $data)
                    . view('connexion/detail_etapes')
                    . view('templates/bas'); ;

                }
            }else{    return redirect()->to(route_to('/'));
            }
        }else{
            return redirect()->to(route_to('/'))->with('error', 'Une erreur est survenue');
        }
    }


    //Fonction pour lister les scenario activé
    public function listerscenario()
    {
        $session = session();
        if ($session->has('user')){
            if($this->model->afficher_role($session->get('user')) == 'O'){
                $data['titre'] = "Liste de tous les scenarios";
                $data['scenarios'] = $this->model->get_all_scenarios();
                return view('templates/haut')
                .view('menu_organisateur',$data)
                . view('connexion/scenarios_affichage')
                . view('templates/bas');
            }else{   
                 return redirect()->to(route_to('accueil/afficher'));
            }
        }else{
             return redirect()->to(route_to('accueil/afficher'));
        }
    }



    //Fonction pour afficher le formulaire d'ajout d'un scenario
    public function afficher_formulaire()
    {
        $session = session();
        if ($session->has('user')) {
            if($this->model->afficher_role($session->get('user')) == 'O'){
                $data['titre'] = 'Veuillez rentrer les données du scénario';
                return view('templates/haut')
                .view('menu_organisateur',$data)
                . view('connexion/creer_scenario')
                . view('templates/bas');
            }else{     
                return redirect()->to(route_to('accueil/afficher'));
            }
        }else {
        return redirect()->to(route_to('accueil/afficher'));
        }
    }

    //Fonction pour creer le scenario
    public function creer_scenario()
    {
        $session = session();
        if ($session->has('user')) {
            if ($this->request->getMethod() == "post") {
                $sce_intitule = $this->request->getPost('intitule');
                $sce_description = $this->request->getPost('description');
                if (empty($sce_intitule) || empty($sce_description)) {
                    return redirect()->to(site_url('compte/afficher_formulaire'))->with('error', 'Veuillez remplir tous les champs du formulaire.');
                }
                $files = $this->request->getFile('userfile');
                if (empty($files)) {
                    return redirect()->to(site_url('compte/afficher_formulaire'))->with('error', 'Veuillez choisir une image.');
                }
                if ($files->getSize() > 1000 * 1024) {
                    return redirect()->to(site_url('compte/afficher_formulaire'))->with('error', 'La taille de l\'image ne doit pas dépasser 1 Mo.');
                }
                $nom_fichier = $files->getName();
                if ($files->move("images", $nom_fichier)) {
                    $sce_img = 'images/' . $nom_fichier;
                    $exec = $this->model->creer_scenario($session->get('user'), $sce_intitule, $sce_description, $sce_img);
                    return redirect()->to(site_url('compte/scenarios_affichage'))->with('success', 'Téléchargement réussi.');
                } else {
                    return redirect()->to(site_url('compte/afficher_formulaire'))->with('error', 'Erreur lors du téléchargement de l\'image.');
                }
            }
        } else {
            // Redirection si l'utilisateur n'est pas connecté
            return redirect()->to(site_url('accueil'));
        }
    }


    //Fonction pour supprimer un scenario
    public function supprimer_scenario()
    {
        $session = session();
        if ($session->has('user')) {
            if ($this->request->getMethod() == "post") {
                $sce_id = $this->request->getPost('sce_id');
                if ($this->model->supprimer_scenario($sce_id)) {
                    return redirect()->to(site_url('compte/scenarios_affichage'))->with('success', 'Scenario supprimé.');
                } else {
                    return redirect()->to(site_url('compte/scenarios_affichage'))->with('error', 'Échec de la suppression.');
                }
            }
        } else {
            // Redirection si l'utilisateur n'est pas connecté
            return redirect()->to(site_url('accueil/afficher'));
        }
    }

}
