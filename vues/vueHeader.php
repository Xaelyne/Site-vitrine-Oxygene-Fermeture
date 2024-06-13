<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- LightBox Photo -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Bootstrap table -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
    <!-- Bootstrap -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
    <!-- LightBox Photo -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrape table -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <!-- Bootstrape table -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table-locale-all.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- css -->
    <link rel="stylesheet" href="./style/style.css">
    <title><?= $titre ?></title>
</head>
<body>

<?php if ($action === "connexion") { ?>
    <nav class="navbar navbar-expand-xxl maNav">
        <div class="container-fluid my-3">
          <a class="navbar-brand text-white fw-bold" href="index.php">Oxygene Fermeture</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" data-bs-theme="dark">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
<?php } else { ?>
    <nav class="navbar navbar-expand-xxl maNav">
        <div class="container-fluid my-3">
          <a class="navbar-brand text-white fw-bold" href="index.php">Oxygene Fermeture</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" data-bs-theme="dark">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav mx-auto">
                    <li class="navbar-brand">
                        <a class="nav-link text-center text-white fs-6" aria-current="page" href="index.php">Accueil</a>
                    </li>
                <li class="navbar-brand dropdown">
                    <a class="nav-link dropdown-toggle text-center text-white fs-6" href="index.php?action=listeServices" role="button" aria-expanded="false">
                    Nos services
                    </a>
                    <ul class="dropdown-menu">
                         <?php foreach ($services as $serviceItem) { ?>
                            <li><a class="dropdown-item" href="index.php?action=detailService&id=<?= htmlspecialchars($serviceItem['id']); ?>"><?= htmlspecialchars($serviceItem['nom']); ?></a></li>
                        <?php } ?>
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
<?php if (isset($_SESSION['idUtilisateur'])) { ?>
            <div class="d-flex align-items-center">
                <a href="index.php?action=gestion">
                        <img src="./images/PanneauUtilisateur2.png" alt="Gestion des utilisateurs" style="width: 3rem;">
                </a>
                <form action="index.php" method="POST">
                    <input type="hidden" name="action" value="deconnexion">
                    <button type="submit" class="btn boutonDeconnexion petitBoutonDeconnexion d-flex align-items-center">
                        <img src="./images/Deconnexion.png" alt="Déconnexion" class="me-2">
                    </button>
                </form>
            </div>
<?php } ?>
        </div>
    </nav>
<?php } ?>