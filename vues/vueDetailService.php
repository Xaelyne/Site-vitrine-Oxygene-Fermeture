<!-- Vue pour le velux -->

<?php
if ($action === "detailVelux") {
?>
    <div class="container-fluid contenu d-flex justify-content-center flex-column align-items-center">
        <div class="text-center mt-5 pt-4" style="width: 60%;">
            <p class="fs-3 texte mb-5">
                Découvrez notre service de pose de velux !
            </p>
            <p class="fs-5 texte">
                Explorez ci-dessous pour en savoir plus sur ce que notre service de pose de velux peut vous offrir.
            </p>
            <p class="fs-5 texte">
                Pour toute question, n'hésitez pas à nous contacter.
            </p>
        </div>
        <div class="d-flex row row-cols-1 row-cols-md- g-4 d-flex justify-content-center align-items-center my-5">
            <div class="card grandeCarte mb-5 text-white text-center my-4" style="width: 10rem;">
                <a class="lienCarte">
                    <img src="./images/Velux.png" class="card-img-top" alt="Service">
                        <div class="card-body">
                            <p class="card-text ">Velux</p>
                        </div>
                </a>
            </div>
        </div>
        <div class="mb-5">
            <ul >
                <li class="texte fs-5">
                    Arrachement de mla toiture
                </li>
                <li class="texte fs-5">
                    Pose de velux
                </li>
                <li class="texte fs-5">
                    Blabla blablabla
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
            </ul>
        </div>
        <div class="my-5 pb-5">
            <a href="index.php?action=realisationVelux" class="btn boutonInverser" role="button" aria-pressed="true">Voir nos réalisation pour la pose de velux</a>
        </div>
    </div>

<?php
}
?>


<!-- Vue pour la fenêtre -->

<?php
if ($action === "detailFenetre") {
    ?>
    <div class="container-fluid contenu d-flex justify-content-center flex-column align-items-center">
        <div class="text-center mt-5 pt-4" style="width: 60%;">
            <p class="fs-3 texte mb-5">
                Découvrez notre service de pose de fenêtre !
            </p>
            <p class="fs-5 texte">
                Explorez ci-dessous pour en savoir plus sur ce que notre service de pose de fenêtre peut vous offrir.
            </p>
            <p class="fs-5 texte">
                Pour toute question, n'hésitez pas à nous contacter.
            </p>
        </div>
        <div class="d-flex row row-cols-1 row-cols-md- g-4 d-flex justify-content-center align-items-center my-5">
            <div class="card grandeCarte mb-5 text-white text-center my-4" style="width: 10rem;">
                <a class="lienCarte">
                    <img src="./images/Velux.png" class="card-img-top" alt="Service">
                        <div class="card-body">
                            <p class="card-text ">Fenêtre</p>
                        </div>
                </a>
            </div>
        </div>
        <div class="mb-5">
            <ul >
                <li class="texte fs-5">
                    Arrachement de mla toiture
                </li>
                <li class="texte fs-5">
                    Pose de Fenêtre
                </li>
                <li class="texte fs-5">
                    Blabla blablabla
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
                <li class="texte fs-5">
                    bloblebee=le
                </li>
            </ul>
        </div>
        <div class="my-5 pb-5">
            <a href="index.php?action=realisationFenetre" class="btn boutonInverser" role="button" aria-pressed="true">Voir nos réalisation pour la pose de Fenetre</a>
        </div>
    </div>
<?php
}
?>