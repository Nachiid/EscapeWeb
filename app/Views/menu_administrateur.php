<body data-bs-spy="scroll" data-bs-target="#navbarExample">
    <!-- Navigation -->
    <nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation">
        <div class="container">
            <!-- Image Logo
            <a class="navbar-brand logo-image" href="index.html"><img src="images/logo.svg" alt="alternative" /></a> -->

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!--<a class="navbar-brand logo-text" href="index.html">Foot Quiz</a> -->

            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ms-auto navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>index.php/compte/afficher_profil">Mon Profil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>index.php/compte/lister">Comptes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>index.php/compte/connecter">Deconnexion</a>
                    </li>

            </div>
            <!-- end of navbar-collapse -->
        </div>
        <!-- end of container -->
    </nav>
    <!-- end of navbar -->
    <!-- end of navigation -->