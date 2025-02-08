
<?php
$session = session();
echo '</br></br></br>
      <h2><center>'.$titre1.'</center></h2>
      </br></br>
      <style>
      table {
          width: 96%;
          margin-left: 2%;
          border-collapse: collapse;
          margin-top: 10px; /* Ajoute un espace en haut du tableau */
      }
  
      th, td {
          border: transparent;
          text-align: left;
          padding: 10px; /* Augmente la taille des cellules */
          height: 50px; /* Définissez la hauteur des cellules */
      }
  
      th {
          background-color: #303036;
          color: #ffffff;
          font-size:  20px;
      }
  
      tr:nth-child(even) td {
          background-color: #303036; /* Définit la couleur de fond grise pour les lignes impaires */
      }
  
      .scenario-image {
          width: 100px; /* Définissez la largeur souhaitée */
          height: auto; /* Laissez la hauteur automatique pour maintenir les proportions de l\'image */
      }

      .action-buttons {
          display: relative;
      }
  </style>
  
      <table>
      <thead>
      <tr>
          <th>Image</th>
          <th>Intitule</th>
          <th>Organisateur</th>
          <th>Description</th>
          <th>Etat</th>
      </tr>
  </thead>
          <tbody>';

if (isset($scenario)){  
    if($scenario->sce_activite == '1'){
        $etat_sce = 'Activé';
    }else{
        $etat_sce = 'Desactivé';
    }
    echo '
          <tr>
          <td><img class="scenario-image" src="' . base_url($scenario->sce_image) . '" alt="Image du scénario"></td>
              <td>' . $scenario->sce_intitule . '</td>
              <td>' . $scenario->cpt_email . '</td>
              <td>' . $scenario->sce_description . '</td>
              <td>' . $etat_sce . '</td>
          </tr>';
}
echo '
          </tbody>
      </table>';

echo '
</br></br></br>
      <h2><center>'.$titre2.'</center></h2></br></br>
<table>
<thead>
<tr>
    <th>Image</th>
    <th>Intitule</th>
    <th>Description</th>
    <th>Reponse</th>
    <th>Etape numero</th> 
</tr>
</thead>
    <tbody>';
foreach ($etapes as $etape) :
echo '
    <tr>
        <td><img class="scenario-image" src="' . base_url($etape->res_chemin) . '" alt="Image du scénario"></td>
        <td>' . $etape->etp_intitule . '</td>
        <td>' . $etape->etp_description . '</td>
        <td>' . $etape->etp_reponse . '</td>
        <td>' . $etape->etp_num . '</td>
    </tr>';
endforeach;
echo '
    </tbody>
</table>';

?>
