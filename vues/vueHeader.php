<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
    <!-- css -->
    <link rel="stylesheet" href="./style/style.css">
    <title><?= $titre ?></title>
</head>
<body> 

    <!-- Les alerts -->
    <!-- <div class="col-12 alert alert-danger d-block d-sm-none text-center" role="alert">Screen X-Small</div>
    <div class="col-sm-12 alert alert-info d-none d-sm-block d-md-none text-center" role="alert">Screen Small ≥576px</div>
    <div class="col-md-12 alert alert-success d-none d-md-block d-lg-none text-center" role="alert">Screen Medium ≥768px</div>
    <div class="col-lg-12 alert alert-warning d-none d-lg-block d-xl-none text-center" role="alert">Screen Large ≥992px</div>
    <div class="col-xl-12 alert alert-dark d-none d-xl-block d-xxl-none text-center" role="alert">Screen X-Large ≥1200px</div>
    <div class="col-xxl-12 alert alert-secondary d-none d-xxl-block text-center" role="alert">Screen XX-Large ≥1400px</div> -->

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-xxl maNav">
        <div class="container-fluid my-3">
          <a class="navbar-brand text-white fw-bold" href="index.php">Oxygène Fermeture</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" data-bs-theme="dark">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav mx-auto">
                <li class="navbar-brand">
                    <a class="nav-link text-center text-white fs-6" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="navbar-brand dropdown">
                    <a class="nav-link dropdown-toggle text-center text-white fs-6" href="index.php?action=listeServices" role="button"  aria-expanded="false">
                    Nos services
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-center" href="index.php?action=detailVelux">Velux</a></li>
                    <li><a class="dropdown-item text-center" href="index.php?action=detailFenetre">Fenêtre</a></li>
                    <li><a class="dropdown-item text-center" href="#">Nom service 3</a></li>
                    </ul>
                </li>
                <li class="navbar-brand dropdown">
                    <a class="nav-link dropdown-toggle text-center text-white fs-6" href="index.php?action=toutesNosRealisations" role="button" aria-expanded="false">
                    Nos réalisations
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-center" href="index.php?action=realisationVelux">Velux</a></li>
                    <li><a class="dropdown-item text-center" href="index.php?action=realisationFenetre">Fenêtre</a></li>
                    <li><a class="dropdown-item text-center" href="#">Nom réalisation 3</a></li>
                    </ul>
                </li>
                <li class="navbar-brand">
                    <a class="nav-link active text-center text-white fs-6" aria-current="page" href="index.php?action=nousContacter">Nous contacter</a>
                </li>
                <li class="navbar-brand text-center mt-1">
                    <a href="index.php?action=devis" class="btn bouton" role="button" aria-pressed="true">Votre devis gratuit en ligne</a>
                </li>
                <li class="navbar-brand text-center mt-1">
                    <a href="#" class="btn bouton" role="button" aria-pressed="true">Avis clients</a>
                </li>
                <a class="navbar-brand text-center mt-1" title="Retrouver notre facebook en cliquant ici" href="https://www.facebook.com/Oxygenefermeture60/?locale=fr_FR" target="_blank">
                    <img src="./images/Facebook.png" alt="Facebook">
                </a>
                <a class="navbar-brand text-center mt-1" title="Vous pouvez nous envoyez un mail directement en cliquant ici" href="mailto:mulett90hh@gmail.com">
                    <img src="./images/Mail.png" alt="Mail">
                </a>
                <a class="navbar-brand text-white text-center mt-1">
                    <img src="./images/Telephone.png" alt="Téléphone"class="d-inline-block align-text-top ">
                    03.44.04.31.13
                </a>
                </ul>
            </div>
        </div>
    </nav>