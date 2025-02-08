<?php
// Ajoutez ce code pour afficher les messages de succès ou d'erreur
if (session()->has('success')) {
    echo '<div class="alert alert-success" role="alert">' . session('success') . '</div>';
} elseif (session()->has('error')) {
    echo '<div class="alert alert-danger" role="alert">' . session('error') . '</div>';
}
?>
<?php
echo '</br></br></br>
<br><br><br>
<div class="btn_scenario">
    <a href="' . site_url("compte/creer") . '">
        <button class="form-control-submit-button" name="submit"><i class="fas fa-plus"></i></button>
    </a>
</div>
      <h2><center>'.$titre.'</center></h2>
      </br></br>
      <style>
      .btn_scenario {
          width: 5%;
          margin-left: 10%;
      }
          table {
              width: 80%;
              margin-left : 10%;
              border-collapse: collapse;
              margin-top: 10px; /* Ajoute un espace en haut du tableau */
          }

          th, td {
              border: transparent;
              text-align: left;
              padding: 15px; /* Augmente la taille des cellules */
          }
          
          th {
            background-color: #303036;
            color: #ffffff;
            font-size:  20px;
        }

          tr:nth-child(even) td {
              background-color: #303036; /* Définit la couleur de fond grise pour les lignes impaires */
          }
      </style>
      <table>
      <thead>
      <tr>
          <th>Email</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Role</th>
          <th>État</th>
         <!-- <th>Action</th> -->
      </tr>
  </thead>
          <tbody>';

foreach ($logins as $login) :
    if ($login->pfl_role == 'A') {
        $Role = "Administrateur";
    } else {
        $Role = "Organisateur";
    }
    
    if ($login->pfl_validite == "1") {
        $etat = "Activé";
    } else {
        $etat = "Désactivé";     
    }

    $formAction = site_url('/compte/changer_etat_profil');
    $buttonValue = $login->cpt_email;
    $buttonIcon = ($login->pfl_validite == "1") ? '<i class="fa fa-times" style="color: red;"></i>' : '<i class="fa fa-arrow-circle-up" style="color: green;"></i>';
    
    
    echo '
          <tr>
              <td>' . $login->cpt_email . '</td>
              <td>' . $login->pfl_nom . '</td>
              <td>' . $login->pfl_prenom . '</td>
              <td>' . $Role . '</td>
              <td>' . $etat . '</td>
            <!--  <td>
                  <form method="post" action="' . $formAction . '">
                      <input type="hidden" name="etat" value="' . $buttonValue . '">
                      <button type="submit" style="background: transparent; border: none;">' . $buttonIcon . '</button>
                  </form>
              </td> -->
          </tr>';
endforeach;
echo '
          </tbody>
      </table>';

?>
