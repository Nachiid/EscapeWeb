<?php $session = session(); ?>
<?php
// Affichage des messages de succès ou d'erreur
if (session()->has('success')) {
    echo '<div class="alert alert-success" role="alert">' . session('success') . '</div>';
} elseif (session()->has('error')) {
    echo '<div class="alert alert-danger" role="alert">' . session('error') . '</div>';
}
?>


<!-- Création d’un formulaire qui pointe vers l’URL de base + /compte/creer -->
<!-- Registration -->
</br></br></br></br></br></br>
<div id="registration" class="form-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <h2><?= $titre; ?> </h2>
                    <hr class="hr-heading">
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <?php
                echo form_open_multipart('/compte/creer_scenario'); ?>
                <?= csrf_field() ?>
                <!-- Registration Form -->
                <form>
                    <div class="mb-4 form-floating">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Intitule" name="intitule">
                        <label for="floatingInput1">Intitule</label>
                    </div>
                    <div class="mb-4 form-floating">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Description" name="description">
                        <label for="floatingInput1">Description</label>
                    </div>
                    <div class="mb-4 form-floating">
                        <input type="file" name="userfile" />
                    </div>
                    <button type="submit" class="form-control-submit-button" name="submit">Creer le scenario</button>
                </form>
                <br><br>
                <div class="btn_scenario">
                    <a href=<?= site_url("compte/scenarios_affichage")?>>
                        <button class="form-control-submit-button" name="submit">Annuler</button>
                    </a>
                </div>
                <!-- end of registrations form -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-1 -->
<!-- end of registration -->
<style>
      .btn_scenario {
          width: 30%;
          margin-left: 40%;
      }
</style>