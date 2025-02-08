<!-- Projects -->
        <div id="projects" class="filter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <div class="title">Actualité</div>
                        </div> <!-- end of box-heading-wrapper -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
<?php echo $titre;?></h1><br />
<?php
if (isset($news)){
echo '
<div class="row">
<div class="col-lg-12">
    <div class="grid">
        <div class="element-item erp">
            <a data-bs-toggle="modal" data-bs-target="#modal1">
            <img class="img-fluid" src="' . base_url('bootstrap/images/messi-2023.jpg') . '" alt="alternative">
                <p><strong>'.$news->act_id.'</strong> ' . $news->act_intitule . '</p>
            </a>
        </div>
    </div> <!-- end of grid -->
    <!-- end of filter -->                        
</div> <!-- end of col -->
</div> <!-- end of row -->';
}
else {
echo ("Pas d'actualité !");
}
echo'            
</div> <!-- end of container -->
</div> <!-- end of filter -->
<!-- end of projects -->';
?>
