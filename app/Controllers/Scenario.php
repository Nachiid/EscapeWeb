<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Scenario extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = model(Db_model::class);
    }

    //Fonction pour afficher les actu
    public function afficher()
    {    
        $data['scenarios'] = $this->model->get_all_scenarios();
        //$data['difficulte'] = $model->get_difficulte_scenario($scenario_id);
        // Charger la vue avec les données
        echo view('templates/haut');
        echo view('menu_visiteur', $data);
        echo view('affichage_scenario');
        echo view('templates/bas');
    }


    //Fonction pour afficher la premier etapes d'un scenario
    public function afficher_premiere_etape($codeScenario = null, $niveaudifficulte = null)
    {

        if ($codeScenario === null || $niveaudifficulte === null) {
            return redirect()->to('/');
        } else {
            $data['etape'] = $this->model->get_etape($codeScenario,$niveaudifficulte);
            $data['titre'] = 'Etes vous un vrai fan de foot ! ';
            return 
            view('templates/haut')
            .view('menu_visiteur', $data)
                . view('affichage_etape')
                . view('templates/bas');
        }
    }
    
    //Fonction pour passer a l'etapes suivantes d'un sceanrio
    public function franchir_etape($codeScenario = null, $niveaudifficulte = null){
        if ($codeScenario === null || $niveaudifficulte === null) {
            return redirect()->to('/');
        }
        if ($this->request->getMethod() == "post"){
            //on peut acceder directement a sce par method post // utiliser dans le else !
            $sce_id = $this->model->switch_code_id($codeScenario)->sce_id;
            if (strtolower($this->request->getPost('reponse')) == strtolower($this->request->getPost('bonne_reponse'))) 
            {
                $num_etape = $this->request->getPost('etp_num');
                if($num_etape < 5){
                    $num_etape = $num_etape + 1;                   
                    $data['etape'] = $this->model->get_next_etape($sce_id,$num_etape, $niveaudifficulte);
                    $data['titre'] = 'Bonne reponse ! Allez au suivant ! ';
                    return
                    view('templates/haut')
                    .view('menu_visiteur', $data)
                    . view('affichage_etape')
                    . view('templates/bas');
                
                }else{
                    return redirect()->to('scenario/finaliser_jeu/' . $codeScenario . '/' . $niveaudifficulte); 
                    //utilisation de get_next etape pour recup la mm etape         
                   /* $data['etape'] = $this->model->get_next_etape($this->request->getPost('sce_id'),$this->request->getPost('etp_num'), $this->request->getPost('ind_diff'));
                    $data['titre'] = 'Veuillez renseignez votre adresse mail pour enregistrer votre victoire !';
                    return
                    view('templates/haut')
                    .view('menu_visiteur', $data)
                    . view('ajout_participant')
                    . view('templates/bas');*/

                }
        }else{
            //utilisation de get_next etape pour recup la mm etape
            $data['etape'] = $this->model->get_next_etape($this->request->getPost('sce_id'),$this->request->getPost('etp_num'), $this->request->getPost('ind_diff'));
            $data['titre'] = 'Nop, mauvaise reponse  ! ';
            return 
            view('templates/haut')
            .view('menu_visiteur', $data)
                . view('affichage_etape')
                . view('templates/bas');
            
        }
        }
    }



    //Fonction pour finaliser le jeu et passer au formulaire participant
    public function finaliser_jeu($codeScenario = null, $niveaudifficulte = null){
        if ($codeScenario === null || $niveaudifficulte === null) {
            return redirect()->to('/');
        } else {           
           /* $sce_id = $this->model->switch_code_id($codeScenario)->sce_id;
            //utilisation de get_next etape pour recup la mm etape         
            $data['etape'] = $this->model->get_next_etape($sce_id,$this->request->getPost('etp_num'), $niveaudifficulte);
            $data['titre'] = 'Veuillez renseignez votre adresse mail pour enregistrer votre victoire !';
            return
            view('templates/haut')
            .view('menu_visiteur', $data)
            . view('ajout_participant')
            . view('templates/bas');*/
            if ($this->request->getMethod() == "post"){
                if (!$this->validate([
                    'par_mail' => 'required'
                ])) {
                    return  redirect()->to('scenario/finaliser_jeu/' . $codeScenario . '/' . $niveaudifficulte);
                   // return   redirect()->to(route_to('scenario/finaliser_jeu/' . $codeScenario . '/' . $niveaudifficulte))->withInput()->with('error', 'Veuillez renseigner votre mail !.');

                }
                $this->model->ajout_participant($this->request->getPost('par_mail'), $this->request->getPost('sce_id'), $this->request->getPost('niveaudifficulte'));
                return redirect()->to(route_to('accueil/afficher'))->withInput()->with('success', 'Votre reussite a été enregister.');
            }
            $data['etape'] = $this->model->get_etape($codeScenario,$niveaudifficulte);
            return
            view('templates/haut')
            .view('menu_visiteur', $data)
            . view('ajout_participant')
            . view('templates/bas');
        }

    }


    //Fonction enregistrer un participant gagnant
    public function ajout_participant(){
        if ($this->request->getMethod() == "post"){
            $code_sce = $this->model->get_scenario($this->request->getPost('sce_id'))->sce_code;
            if (!$this->validate([
                'par_mail' => 'required'
            ])) {
                $data['etape'] = $this->model->get_etape($code_sce,$this->request->getPost('ind_diff'));
                return
                view('templates/haut')
                .view('menu_visiteur', $data)
                . view('ajout_participant')
                . view('templates/bas');
            }
            $this->model->ajout_participant($this->request->getPost('par_mail'), $this->request->getPost('sce_id'), $this->request->getPost('niveaudifficulte'));
            return redirect()->to(route_to('accueil/afficher'))->withInput()->with('success', 'Votre reussite a été enregister.');
        }
    }
}
?>