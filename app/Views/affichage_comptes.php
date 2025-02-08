        <!-- Video -->
        <div class="basic-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">    
                        <!-- Video Preview -->
                        <br/><br/>
                        <h2><?php echo $titre; ?></h2>
                        <div class="image-container">
                            <div class="video-wrapper">
                                <img class="img-fluid" src="<?php echo base_url();?>bootstrap/images/video-preview.jpg" alt="alternative">
                            </div> <!-- end of video-wrapper -->
                        </div> <!-- end of image-container -->
                        <!-- end of video preview -->    
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="text-container">
                            <h4>Nombre totale des comptes : <?php echo $total_comptes; ?></h4>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
<?php
if (! empty($logins) && is_array($logins))
{
foreach ($logins as $pseudos)
{
echo '<br/> 
<div class="row">
<div class="col-lg-4">
    <div class="text-container">
        <h4>'.$pseudos["cpt_email"].'</h4>
    </div> <!-- end of text-container -->
</div> <!-- end of col -->
</div> <!-- end of row -->';
}
}
else {
 echo("<h3>Aucun compte pour le moment</h3>");
}
echo'
</div> <!-- end of container -->
</div> <!-- end of basic-3 -->
<!-- end of video -->

';
?>