
<!-- Solutions -->
        <div id="solutions" class="cards-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <div class="title">Scenario</div>
                        </div> <!-- end of section-title -->
                        <h2 class="h2-heading">Vous pouvez jouer à nos scenario sans avoir un compte</h2>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
                <div class="row">
                    <div class="col-lg-12"> 
<?php
foreach($scenarios as $scenario)
echo'                      
<!-- Card -->
<div class="card">
    <div class="card-image">
        <img class="img-fluid" src="' . base_url() . $scenario->sce_image . '" alt="alternative">
    </div>
    <div class="card-body">
        <h4 class="card-title"><a href="https://obiwan.univ-brest.fr/~e22111435/index.php/scenario/afficher_premiere_etape/'.$scenario->sce_code.'/F">'.$scenario->sce_intitule.'</a></h4>
        <p>'.$scenario->sce_description.'</p>
        <p><strong>Difficulté :</strong> <a href="https://obiwan.univ-brest.fr/~e22111435/index.php/scenario/afficher_premiere_etape/'.$scenario->sce_code.'/F">Facile</a> / <a href="https://obiwan.univ-brest.fr/~e22111435/index.php/scenario/afficher_premiere_etape/'.$scenario->sce_code.'/M">Moyen</a> / <a href="https://obiwan.univ-brest.fr/~e22111435/index.php/scenario/afficher_premiere_etape/'.$scenario->sce_code.'/D">Difficile </a></p>
        <div class="tag">'.$scenario->cpt_email.'</div>
    </div>
</div>
<!-- end of card -->
';
?>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of cards-1 -->
        <!-- end of solutions -->
        