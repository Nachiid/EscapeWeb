<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Accueil extends BaseController
{
    public function afficher()
    {
        $model = new Db_model();

        // Appel de la fonction pour obtenir toutes les actualités
        $data['actualites'] = $model->get_all_actualites();
        // Charger la vue avec les données
        echo view('templates/haut.php');
        echo view('menu_visiteur', $data);
        echo view('affichage_accueil');
        echo view('templates/bas');
    }
}
?>