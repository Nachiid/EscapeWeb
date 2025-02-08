<?php
$session = session();
$user = $session->get('user');
?>

</br></br></br></br></br></br>
<!-- Statement -->
<div class="basic-4-wrapper">
    <div class="basic-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h4>Bonjour <?php echo $user ?>. Vous êtes connecté à l'espace privé de l'application</h4>
                        <a class="btn-outline-lg" href="<?php echo base_url();?>index.php/compte/afficher_profil">Mon profil</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-4 -->
</div> <!-- end of basic-4-wrapper -->
<!-- end of statement -->
