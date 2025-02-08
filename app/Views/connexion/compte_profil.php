<?php
$session = session();
$user = $session->get('user');

if ($profil->pfl_role == 'A') {
    $Role = "Administrateur";
} else {
    $Role = "Organisateur";
}

if ($profil->pfl_validite == "1") {
    $etat = "Activé";
} else {
    $etat = "Désactivé";
}
?>
<?php
//code des messsages d'erreur ou tt est bien passe !
if (session()->has('success')) {
    echo '<div class="alert alert-success" role="alert">' . session('success') . '</div>';
} elseif (session()->has('error')) {
    echo '<div class="alert alert-danger" role="alert">' . session('error') . '</div>';
}
?>

</br></br></br></br></br></br></br></br>

<?php
echo '
    <!-- Details 1 -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="text-container">
                        <h2>' . $titre . ' </h2>
                        <hr class="hr-heading"></br></br>
                        <ul class="list-unstyled li-space-lg">
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1"><strong>Nom Et Prenom   </strong> ' . $profil->pfl_nom . '  ' . $profil->pfl_prenom . '</div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1"><strong>Adresse mail   </strong>' . $user . '</div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1"><strong>Role   </strong> ' . $Role . '</div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1"><strong>Etat   </strong> ' . $etat . '</div>
                            </li>
                        </ul> <!-- end of list-unstyled -->
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-7">
                    <div class="image-container">
                        <img class="img-fluid" src="' . base_url("bootstrap/images/details-1.jpg") . '" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
        <img class="vertical-decoration" src="' . base_url("bootstrap/images/vertical-decoration-left.svg") . '" alt="alternative">
    </div> <!-- end of basic-1 -->
    <!-- end of details 1 -->';

echo '
    <!-- Details 2 -->
    <div class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="image-container">
                        <img class="img-fluid" src="' . base_url("bootstrap/images/details-2.jpg") . '" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-5">
                    <div class="text-container">
                        <h2>Modifier mon mot de passe </h2>
                        <hr class="hr-heading">
                        <p>Veuillez rentrer et confirmer votre nouveau mot de passe </p>';
                        ?>
                        <?= form_open('/compte/modifier_mot_de_passe') ?>
                        <?php echo '
                        <div class="mb-4 form-floating">
                            <input type="password" class="form-control" id="floatingInput1" placeholder="mot de passe" name="mdp">
                            <label for="floatingInput1">Nouveau mot de passe</label>';?>
                            <?= validation_show_error('mdp') ?>
                        <?php echo '
                        </div>
                        <div class="mb-4 form-floating">
                            <input type="password" class="form-control" id="floatingInput2" placeholder="Confirmation mot de passe" name="conf_mdp">
                            <label for="floatingInput2">Confirmation mot de passe</label>';?>
                            <?= validation_show_error('conf_mdp') ?>
                        <?php echo '
                        </div>
                        <button type="submit" class="form-control-submit-button" name="submit">Confirmer le changement</button>
                    </form>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
        <img class="vertical-decoration" src="' . base_url("bootstrap/images/vertical-decoration-left.svg") . '" alt="alternative">
    </div> <!-- end of basic-2 -->
    <!-- end of details 2 -->    
';
?>
