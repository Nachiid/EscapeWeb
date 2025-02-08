<?php
// Ajoutez ce code pour afficher les messages de succès ou d'erreur
if (session()->has('error')) {
    echo '<div class="alert alert-danger" role="alert">' . session('error') . '</div>';
}
?>
</br></br></br></br></br></br></br>
<!-- Création d’un formulaire qui pointe vers l’URL de base + /compte/creer -->
<!-- Registration -->
<div id="registration" class="form-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <h2><?php echo $titre; ?> </h2>
                    <hr class="hr-heading">
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <?php    
                echo form_open('/compte/connecter'); ?>
                <?= csrf_field() ?>
                <!-- Registration Form -->
                <form>
                    <div class="mb-4 form-floating">
                        <input type="email" class="form-control" id="floatingInput2" placeholder="name@example.com" name="pseudo">
                        <label for="floatingInput2">Email</label>
                    </div>
                    <div class="mb-4 form-floating">
                        <input type="password" class="form-control" id="floatingInput1" placeholder="mot de passe" name="mdp">
                        <label for="floatingInput1">Mot de passe</label>
                    </div>
                    <button type="submit" class="form-control-submit-button" name="submit">Se connecter</button>
                </form>
                <!-- end of registrations form -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-1 -->
<!-- end of registration -->
