<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Etape extends BaseController
{

    private $model;

    public function __construct()
    {
        helper('form');
        $this->model = model(Db_model::class);
    }
    
    public function afficher($codeScenario = null, $niveaudifficulte = null)
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
}

?>