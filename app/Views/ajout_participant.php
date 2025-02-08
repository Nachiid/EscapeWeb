<?php
// Ajoutez ce code pour afficher les messages de succès ou d'erreur
if (session()->has('error')) {
    echo '<div class="alert alert-danger" role="alert">' . session('error') . '</div>';
}
?>
</br></br></br></br></br></br></br>
<?php    
/*echo form_open('scenario/ajout_participant');*/ 
echo form_open("scenario/finaliser_jeu/$etape->sce_code/$etape->ind_difficulte");
?>

<?= csrf_field() ?>
</br></br></br></br></br>
<?php
if (isset($etape)){
echo' 
<!-- success -->
        <div class="form-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="h2-heading">Vous avez reussis le scenario</h2>
                    <p class="p-heading">Veuillez renseignez votre adresse mail pour enregistrer votre victoire !</p>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <!-- participant Form -->
                        <form method = "post">
                            <div class="mb-4 form-floating">
                                <input type="email" class="form-control" id="floatingInput4" placeholder="name@example.com" name="par_mail">
                                <label for="floatingInput4">Email address</label>
                                <input type="hidden" class="form-control" id="floatingInput4" placeholder="name@example.com" name="sce_id" value="'. $etape->sce_id.'">
                                <input type="hidden" class="form-control" id="floatingInput4" placeholder="name@example.com" name="niveaudifficulte" value="'.$etape->ind_difficulte.'">                               
                            </div>
                            <button type="submit" class="form-control-submit-button">Envoyer</button>
                        </form>
                        <!-- end of participant form -->
                        
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of form-2 -->
<!-- end of success -->
';}
else {echo "pas d'etape";}

?>