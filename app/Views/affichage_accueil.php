<?php
// Ajoutez ce code pour afficher les messages de succès ou d'erreur
if (session()->has('success')) {
    echo '<div class="alert alert-success" role="alert">' . session('success') . '</div>';
}
?> 
 <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h1 class="h1-large">Football Quiz <span class="replace-me">Jouer et gagner des trophés</span></h1>
                        <a class="btn-solid-lg page-scroll" href="<?php echo base_url();?>index.php/scenario">Learn More</a>
                    </div>  <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
        <img class="vertical-decoration" src="<?php echo base_url();?>bootstrap/images/vertical-decoration-left.svg" alt="alternative">
    </header> <!-- end of header -->
<!-- end of header -->
<?php
echo '</br></br></br>
      <h2><center>Actualité</center></h2>
      </br></br>
      <style>
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

          tr:nth-child(even) {
              background-color: #303036; /* Définit la couleur de fond grise pour les lignes impaires */
          }
      </style>
      <table>
          <tbody>';

foreach ($actualites as $actualite) :
    echo '
          <tr>
              <td><h5>' . $actualite->act_intitule . '</h5></td>
              <td>' . $actualite->act_description . '</br><strong> Fait le '.$actualite->act_date.' par '.$actualite->cpt_email.'</strong></td>
          </tr>';
endforeach;

echo '
          </tbody>
      </table>';
?>

