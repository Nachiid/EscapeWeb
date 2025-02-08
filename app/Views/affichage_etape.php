</br></br></br></br></br>
<?php
if (isset($etape)){
echo' 
<!-- Details 1 -->
<center><h2>'.$titre. '</h2></center>
</br></br></br></br>
<div id="details" class="basic-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="text-container">
                    <h2>'.$etape->etp_intitule. '</h2>
                    <hr class="hr-heading">
                    <p><strong>'.$etape->etp_description.'</strong></p>                    
                </div></br></br> <!-- end of text-container -->'; ?>

                <?php
                $milieu_etapes = 'scenario/franchir_etape/'.$etape->sce_code.'/'.$etape->ind_difficulte.'';  
                $fin_etapes = 'scenario/finaliser_jeu/'.$etape->sce_code.'/'.$etape->ind_difficulte.'';
                
                if($etape->etp_num >= 5)
                {
                    $etape_en_cours = $milieu_etapes;
                }else{
                    $etape_en_cours = $milieu_etapes;
                }
                
                echo form_open($etape_en_cours); ?>
                <?= csrf_field() ?>
                <?php 
                echo '
                <form>
                <div class="mb-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput1" placeholder="Reponse" name="reponse">
                    <input type="hidden" class="form-control" id="floatingInput1"  name="bonne_reponse"   value ="'.$etape->etp_reponse.'" >
                    <input type="hidden" class="form-control" id="floatingInput1"  name="sce_id"   value ="'.$etape->sce_id.'" >
                    <input type="hidden" class="form-control" id="floatingInput1"  name="etp_num"   value ="'.$etape->etp_num.'" >
                    <input type="hidden" class="form-control" id="floatingInput1"  name="ind_diff"   value ="'.$etape->ind_difficulte.'" >
                    <label for="floatingInput1">Reponse</label>
                </div>';
                if (!empty($etape->ind_lien)){
                    echo'
                    <a href="'.($etape->ind_lien).'"><strong>Indice</strong></a>
                
                <br><br>
                
                ';}  
            echo' 
            <button type="submit" class="form-control-submit-button">Confirmer</button>
            </form>
            </div> <!-- end of col -->
            <div class="col-lg-7">
                <div class="image-container">
                </br>
                <img class="img-fluid" src="' . base_url($etape->res_chemin) . '" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->    
    </div> <!-- end of container -->
    <img class="vertical-decoration" src="' . base_url("bootstrap/images/vertical-decoration-left.svg") . '" alt="alternative">
</div> <!-- end of basic-1 -->

';}

else {echo "pas d'etape";}

?>