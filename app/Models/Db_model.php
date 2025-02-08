<?php

namespace App\Models;

use CodeIgniter\Model;

class Db_model extends Model
{
    protected $db;

    //constructeur pour charger la base de donnée
    public function __construct()
    {
        $this->db = db_connect(); // Charger la base de données
    }

    // Fonction de récupération des comptes
    public function get_all_compte()
    {
        $resultat = $this->db->query("SELECT cpt_email, pfl_nom, pfl_prenom, pfl_role, pfl_validite
        FROM T_compte_cpt
        JOIN T_profil_pfl USING(cpt_id)
        ORDER BY pfl_validite DESC;
        ");
        return $resultat->getResult();
    }

    // Fonction de calcul du nombre des comptes dans la table
    public function count_all_comptes()
    {
        return $this->db->table('T_compte_cpt')->countAll();
    }

    // Fonction de récupération d'une actualité
    public function get_actualite($numero)
    {
        $requete = "SELECT * FROM T_actualite_act WHERE act_id=" . $numero . ";";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    // Fonction de récupération de toutes les actualités
    public function get_all_actualites()
    {
        $resultat = $this->db->query("SELECT act_id, act_intitule, act_description, act_validite, act_date, cpt_email FROM T_actualite_act JOIN T_compte_cpt USING(cpt_id) WHERE act_validite = 1;");
        return $resultat->getResult();
    }

    //Fonction pour recuperer un scenario
    public function get_scenario($sce_id){
        $requete = "SELECT sce_id, sce_intitule,sce_code, sce_description, sce_activite, sce_image, cpt_email, etp_id, ind_id, res_id FROM T_scenario_sce JOIN T_compte_cpt USING(cpt_id) 
        LEFT JOIN T_etape_etp USING(sce_id) LEFT JOIN T_indice_ind USING(etp_id) LEFT JOIN T_ressource_res USING(res_id)  WHERE sce_id = $sce_id";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }


    // Fonction de récuperation des  scénarios
    public function get_all_scenarios()
    {
        $resultat = $this->db->query("SELECT sce_id, sce_intitule, sce_activite, sce_description, sce_image, cpt_email, sce_code, MIN(etp_code), COUNT(DISTINCT etp_code) as nb_etp, ind_difficulte 
        FROM T_scenario_sce 
        JOIN T_compte_cpt USING (cpt_id) LEFT JOIN T_etape_etp USING(sce_id) LEFT JOIN T_indice_ind USING(etp_id)  WHERE sce_activite = '1' 
        GROUP BY sce_id");

        $scenarios = $resultat->getResult();

        foreach ($scenarios as &$scenario) {
            $scenario->difficulte = $this->get_difficulte_scenario($scenario->sce_id);
        }

        return $scenarios;
    }

    // Fonction de recuperation des difficultés d'un scenario a partir de ces etapes
    public function get_difficulte_scenario($scenario_id)
    {
        $resultat = $this->db->query("SELECT MIN(ind_difficulte) as difficulte FROM T_scenario_sce 
        LEFT JOIN T_etape_etp USING(sce_id) LEFT JOIN T_indice_ind USING(etp_id) WHERE sce_id = $scenario_id;");
        return $resultat->getRow()->difficulte;
    }

    // Fonction de récupération d'une etape
    public function get_etape($sce_code, $niveaudifficulte)
    {
        $resultat = $this->db->query("SELECT sce_code, sce_id, res_chemin, etp_num,  etp_intitule, etp_reponse,  etp_description, ind_description, ind_difficulte,  ind_lien FROM T_scenario_sce
        JOIN T_etape_etp USING(sce_id) LEFT JOIN T_indice_ind ON T_etape_etp.etp_id = T_indice_ind.etp_id 
        LEFT JOIN T_ressource_res USING(res_id) WHERE ind_difficulte = '$niveaudifficulte' AND sce_code = '$sce_code'");
        return $resultat->getRow();
    }

    //Fonction pour recuperer tous les etapes 
    public function get_all_etape($sce_id){
        $result = $this->db->query ("SELECT res_chemin, etp_intitule, etp_code, etp_id, etp_description, etp_reponse, etp_num FROM T_etape_etp JOIN T_scenario_sce USING(sce_id) JOIN T_ressource_res USING(res_id) WHERE sce_id = $sce_id  ;");
        return $etapes = $result->getResult();
    }

    // Fonction de récupération des numeros des comptes
    public function get_nb_comptes()
    {
        $resultat = $this->db->query("SELECT COUNT(*) as nb FROM T_compte_cpt;");
        return $resultat->getRow();
    }

    // Fonction d'insertion d'un nouveau compte
    public function set_compte($saisie, $role, $etat)
    {
        $login = $saisie['pseudo'];
        $mot_de_passe = $saisie['mdp'];
        $nom = $saisie['nom'];
        $prenom = $saisie['prenom'];

        // Vérifier si le login existe
        $existingLogin = $this->db->table('T_compte_cpt')->where('cpt_email', $login)->countAllResults();

        if ($existingLogin == 0) {
            // mot de passe salé haché
            //$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
            //$password = hash('sha256', $salt . $mot_de_passe);

            $sql_compte = "INSERT INTO T_compte_cpt(cpt_email, cpt_mdp) VALUES(?, ?)";
            $this->db->query($sql_compte, [$login, $mot_de_passe]);

            // Récupération de l'ID auto-incrémenté généré pour la dernière insertion
            $cpt_id_temp = "SELECT LAST_INSERT_ID() as id";
            $result = $this->db->query($cpt_id_temp)->getRow();
            $cpt_id = $result->id;

            // Insertion dans la table T_profil_pfl avec l'ID récupéré
            $sql_profil = "INSERT INTO T_profil_pfl(cpt_id, pfl_nom, pfl_prenom, pfl_role, pfl_validite) VALUES(?, ?, ?, ?, ?)";
            $this->db->query($sql_profil, [$cpt_id, $nom, $prenom, $role, $etat]);

            // Vérifier si l'insertion du profil a réussi
            $profileInsertionSuccess = $this->db->affectedRows() > 0;

            if (!$profileInsertionSuccess) {
                // Supprimer le compte créé en cas d'échec de l'insertion du profil
                $this->db->table('T_compte_cpt')->where('cpt_id', $cpt_id)->delete();
                echo 'Erreur lors de l\'insertion du profil. Le compte a été supprimé.';
            }
        } else {
        echo 'Login existant';
        }
    }

    //Fonction pour chercher si un compte existe
    public function connect_compte($u,$p)
    {
        $sql="SELECT cpt_email,cpt_mdp
        FROM T_compte_cpt JOIN T_profil_pfl USING (cpt_id)
        WHERE cpt_email='".$u."'
        AND cpt_mdp='".$p."' AND pfl_validite = '1' ;";
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0)
        {
            return true;
        }else
        {
        return false;
        }
    }
    
    //Fonction pour afficher les données d'un profil
    public function afficher_profil($u)
    {
        $sql = "SELECT pfl_nom , pfl_prenom, cpt_id, cpt_email, pfl_role , pfl_validite FROM T_compte_cpt join T_profil_pfl using(cpt_id) where cpt_email = '" . $u . "';";
        $resultat = $this->db->query($sql);
        return $resultat->getRow();
    }

    //Fonction pour afficher les roles
    public function afficher_role($u)
    {
        $sql = "SELECT pfl_role FROM T_profil_pfl JOIN T_compte_cpt USING(cpt_id) WHERE cpt_email = ?;";
        $resultat = $this->db->query($sql, [$u]);
        $row = $resultat->getRow();

        if ($row) {
            return $row->pfl_role;
        }
    }
    
    //Fonction de modification du mot de passe 
    public function modifier_mdp($u,$mdp){
        $sql = "CALL modifier_mdp_procedure(?, ?)";
        $resultat = $this->db->query($sql, [$u, $mdp]);
        if($resultat){
            return true;
        }else {
            return false;
        }
    }
    
    //fonction pour changer l'etat du profil
    public function changer_etat_profil($cpt_email)
    {
        $profil_etat = $this->db->query("SELECT pfl_validite FROM T_profil_pfl JOIN T_compte_cpt USING(cpt_id) WHERE cpt_email = '$cpt_email'")->getRow()->pfl_validite;
        $nouvel_etat = ($profil_etat == 1) ? 0 : 1;
        $sql = "UPDATE T_profil_pfl JOIN T_compte_cpt USING(cpt_id) SET pfl_validite = '$nouvel_etat' WHERE cpt_email = '$cpt_email'";
        $resultat = $this->db->query($sql);
    
        return ($this->db->affectedRows() > 0);
    }
    
    //Fonction d'ajout d'un scenario 
    public function creer_scenario($cpt_email, $intitule, $description, $image)
    {
        $cpt_id = $this->afficher_profil($cpt_email)->cpt_id;
        $requete_insert = "INSERT INTO T_scenario_sce (sce_intitule, sce_description, sce_image, cpt_id, sce_activite ) VALUES (?, ?, ?, ?,'1')";
        $resultat_insert = $this->db->query($requete_insert, [$intitule, $description, $image, $cpt_id]);
    }


    //Fonction pour recuperer un scenario
    public function get_scenario_table($sce_id)
    {
        $requete = "SELECT sce_id, sce_intitule, par_id, sce_description, sce_activite, sce_image, cpt_email, etp_id, ind_id, res_id FROM T_scenario_sce JOIN T_compte_cpt USING(cpt_id) 
                LEFT JOIN T_etape_etp USING(sce_id) LEFT JOIN T_indice_ind USING(etp_id) LEFT JOIN T_ressource_res USING(res_id) LEFT JOIN T_reussite_reu USING (sce_id)  WHERE sce_id = $sce_id";
                $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    //Fonction pour supprimer un scenario
    public function supprimer_scenario($sce_id)
    {
        // Récupérer les informations du scénario
        $info_sce = $this->get_scenario_table($sce_id);
        foreach ($info_sce as $info) :
            if ($info['par_id'] != null) 
            {
                $sup_par = "DELETE FROM T_reussite_reu WHERE par_id = ".$info['par_id']."";
                $this->db->query($sup_par);
            }
            if ($info['ind_id'] != null) 
            {
                $sup_ind = "DELETE FROM T_indice_ind WHERE ind_id = ".$info['ind_id']."";
                $this->db->query($sup_ind);
            }    
            /* if ($info['res_id'] != null) {
                $sup_res = "DELETE FROM T_ressource_res WHERE res_id = ".$info['res_id']."";
                $this->db->query($sup_res);
            }*/
    
            if ($info['etp_id'] != null) {
                $sup_etp = "DELETE FROM T_etape_etp WHERE etp_id = ".$info['etp_id']."";
                $this->db->query($sup_etp);
            }
        endforeach;
        $sup_sce = "DELETE FROM T_scenario_sce WHERE sce_id = $sce_id";
        $result = $this->db->query($sup_sce);
        $verif = "SELECT * FROM T_scenario_sce WHERE sce_id = $sce_id";
        $result = $this->db->query($verif);
        return $result->getRow() === null;
    }
    
    // Fonction de récupération d'une etape
    public function get_next_etape($sce_id, $etp_num, $niveaudifficulte)
    {
        $resultat = $this->db->query("SELECT  sce_code, sce_id, ind_description, ind_lien, etp_id, res_chemin, ind_difficulte, etp_code, etp_intitule, etp_description, etp_reponse, etp_num FROM T_scenario_sce JOIN
         T_etape_etp USING(sce_id) LEFT JOIN T_indice_ind USING(etp_id) LEFT JOIN T_ressource_res USING(res_id) WHERE etp_num = '$etp_num' AND sce_id = '$sce_id' AND ind_difficulte = '$niveaudifficulte';");
        return $resultat->getRow();
    }



    // Fonction d'ajout d'un participant en cas de reuusite
    public function ajout_participant($par_mail, $sce_id, $niveaudifficulte)
    {
        $participant_exi = $this->db->query("SELECT par_id FROM T_participant_par WHERE par_mail = '$par_mail'");
        if ($participant_exi->getNumRows() == 0) 
        {
            $insert1 = $this->db->query("INSERT INTO T_participant_par(par_mail) VALUES('$par_mail');");
            $par_id_re = "SELECT LAST_INSERT_ID() as id";
            $result = $this->db->query($par_id_re)->getRow();
            $par_id = $result->id;
        } else {
            // Le participant existe déjà, récupérer son ID
            $participant_exi_row = $participant_exi->getRow();   
            $par_id = $participant_exi_row->par_id;
        }
        $reussite_exis = $this->db->query("SELECT * FROM T_reussite_reu WHERE sce_id = '$sce_id' AND par_id = '$par_id' AND reu_difficulte = '$niveaudifficulte'");
        if ($reussite_exis->getNumRows() == 1) 
        {
            $reussite_exis_row = $reussite_exis->getRow();
            $maj_reu = $this->db->query("UPDATE T_reussite_reu SET reu_derniere_date = NOW() WHERE sce_id = $reussite_exis_row->sce_id  AND reu_difficulte = '$niveaudifficulte' ");
        } else {
            $insert2 = $this->db->query("INSERT INTO T_reussite_reu(sce_id, par_id, reu_premiere_date, reu_derniere_date, reu_difficulte) VALUES('$sce_id','$par_id',NOW(), NOW(), '$niveaudifficulte');");
        }
    }


    //Fonction pour avior id d'un scenario
    public function switch_code_id($code_sce)
    {
        $resultat = $this->db->query("SELECT  sce_id FROM T_scenario_sce WHERE sce_code = '$code_sce'");
        return $resultat->getRow();
    }

}
