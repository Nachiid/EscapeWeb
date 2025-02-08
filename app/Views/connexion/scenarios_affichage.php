<?php
// Affichage des messages de succès ou d'erreur
if (session()->has('success')) {
    echo '<div class="alert alert-success" role="alert">' . session('success') . '</div>';
} elseif (session()->has('error')) {
    echo '<div class="alert alert-danger" role="alert">' . session('error') . '</div>';
}

$session = session();

echo '<br><br><br><br><br><br>
      <h2><center>' . $titre . '</center></h2>
      <br><br>
      <style>
          .btn_scenario {
              width: 5%;
              margin-left: 2%;
          }

          table {
              width: 96%;
              margin-left: 2%;
              border-collapse: collapse;
              margin-top: 10px; 
          }

          th, td {
              border: transparent;
              text-align: left;
              padding: 10px; 
              height: 50px; 
          }

          th {
              background-color: #303036;
              color: #ffffff;
              font-size: 20px;
          }

          tr:nth-child(even) td {
              background-color: #303036; 
          }

          .scenario-image {
              width: 100px; 
              height: auto; 
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
                  <th>Code</th> 
                  <th>Organisateur</th>
                  <th>Nombre d\'étape</th>
                  <th>Action</th>
                  <th></th> 
                  <th></th> 
              </tr>
          </thead>
          <tbody>';

foreach ($scenarios as $scenario) :
    $formActiondetail = site_url('/compte/detail_etapes');
    $formActioncopier = site_url('');
    $formActionremise0 = site_url('/compte/remise_a_zero');
    $formActionsupprimer = site_url('/compte/supprimer_scenario');
    $formAction_etat = site_url('');
    $buttonValue = $scenario->sce_id;
    $buttonIcon = ($scenario->sce_activite == "1") ? '<i class="fa fa-times" style="color: red;"></i>' : '<i class="fa fa-arrow-circle-up" style="color: green;"></i>';

    if ($scenario->cpt_email == $session->get('user')) {
        echo '
            <tr>
                <td><img class="scenario-image" src="' . base_url($scenario->sce_image) . '" alt="Image du scénario"></td>
                <td>' . $scenario->sce_intitule . '</td>
                <td>' . $scenario->sce_code . '</td>
                <td>' . $scenario->cpt_email . '</td>
                <td>' . $scenario->nb_etp . '</td>
                <td class="action-buttons">
                    <form method="post" action="' . $formActiondetail . '">
                        <input type="hidden" name="sce_id" value="' . $buttonValue . '">
                        <button type="submit" style="background: transparent; border: none;"><i class="fas fa-eye" style="color: white;"></i></button>
                    </form>
                    <form method="post" action="' . $formActioncopier . '">
                        <input type="hidden" name="sce_id" value="' . $buttonValue . '">
                        <button type="submit" style="background: transparent; border: none;"><i class="far fa-copy" style="color: white;"></i></button>
                    </form>
                </td>
                <td class="action-buttons">
                    <form method="post" action="">
                        <input type="hidden" name="sce_id" value="' . $buttonValue . '">
                        <button type="submit" style="background: transparent; border: none;"><i class="fas fa-undo-alt" style="color: white;"></i></button>
                    </form>
                    <form method="post" action="'.$formActionsupprimer.'">
                        <input type="hidden" name="sce_id" value="' . $buttonValue . '">
                        <button type="submit" style="background: transparent; border: none;"><i class="fas fa-trash-alt" style="color: white;"></i></button>
                    </form>
                </td>
                <td>
                    <form method="post" action="' . $formAction_etat . '">
                        <input type="hidden" name="etat" value="' . $buttonValue . '">
                        <button type="submit" style="background: transparent; border: none;">' . $buttonIcon . '</button>
                    </form>
                </td>
            </tr>';
    }
endforeach;

foreach ($scenarios as $scenario) :
    $formActiondetail = site_url('/compte/detail_etapes');
    $formActioncopier = site_url('');
    $buttonValue = $scenario->sce_id;

    if (($scenario->cpt_email != $session->get('user'))) {
        echo '
            <tr>
                <td><img class="scenario-image" src="' . base_url($scenario->sce_image) . '" alt="Image du scénario"></td>
                <td>' . $scenario->sce_intitule . '</td>
                <td>' . $scenario->sce_code . '</td>
                <td>' . $scenario->cpt_email . '</td>
                <td>' . $scenario->nb_etp . '</td>
                <td class="action-buttons">
                    <form method="post" action="' . $formActiondetail . '">
                        <input type="hidden" name="sce_id" value="' . $buttonValue . '">
                        <button type="submit" style="background: transparent; border: none;"><i class="fas fa-eye" style="color: white;"></i></button>
                    </form>
                    <form method="post" action="' . $formActioncopier . '">
                        <input type="hidden" name="sce_id" value="' . $buttonValue . '">
                        <button type="submit" style="background: transparent; border: none;"><i class="far fa-copy" style="color: white;"></i></button>
                    </form>
                </td>
                <td></td>
                <td></td>
            </tr>';
    }
endforeach;
echo '
          </tbody>
      </table>';

echo '
<br><br><br>
<div class="btn_scenario">
    <a href="' . site_url("compte/afficher_formulaire") . '">
        <button class="form-control-submit-button" name="submit"><i class="fas fa-plus"></i></button>
    </a>
</div>';
?>
