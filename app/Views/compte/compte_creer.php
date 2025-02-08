<?= session()->getFlashdata('error'); ?>
<?= validation_list_errors(); ?>

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
                echo form_open('/compte/creer'); ?>
                <?= csrf_field() ?>
                <!-- Registration Form -->
                <form>
                    <div class="mb-4 form-floating">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Nom" name="nom" >
                        <label for="floatingInput1">Nom</label>
                        <?php echo validation_show_error('nom'); ?>
                    </div>
                    <div class="mb-4 form-floating">
                        <input type="text" class="form-control" id="floatingInput1" placeholder="Prenom" name="prenom">
                        <label for="floatingInput1">Prenom</label>
                        <?php echo validation_show_error('prenom'); ?>
                    </div>
                    <div class="mb-4 form-floating">
                        <input type="email" class="form-control" id="floatingInput2" placeholder="name@example.com" name="pseudo">
                        <label for="floatingInput2">Email</label>
                        <? validation_show_error('pseudo'); ?>
                    </div>
                    <div class="mb-4 input-group">
                                <select class="form-select" id="inputGroupSelect1" name="role">
                                    <option selected>Choisissez un role</option>
                                    <option name="adm" value="adm">Administrateur</option>
                                    <option name="org" value="org">Organisateur</option>
                                    <? validation_show_error('cat'); ?>
                                </select>
                    </div>
                    <div class="mb-4 input-group">
                                <select class="form-select" id="inputGroupSelect1" name="etat">
                                    <option selected>Choisissez un etat </option>
                                    <option name="act" value="act">Activé</option>
                                    <option name="des" value="des">Desactivé</option>
                                    <? validation_show_error('etat'); ?>
                                </select>
                    </div>
                    <div class="mb-4 form-floating">
                        <input type="password" class="form-control" id="floatingInput1" placeholder="mot de passe" name="mdp">
                        <label for="floatingInput1">Mot de passe</label>
                        <? validation_show_error('mdp') ?>
                    </div>
                    <div class="mb-4 form-floating">
                        <input type="password" class="form-control" id="floatingInput1" placeholder="Name" name="conf_mdp">
                        <label for="floatingInput1">Confirmation mot de passe</label>
                        <? validation_show_error('c_mdp') ?>
                    </div>
                    <button type="submit" class="form-control-submit-button" name="submit">S'inscrire</button>
                </form>
                <br><br>
                <div class="btn_scenario">
                    <a href=<?= site_url("compte/lister")?>>
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
