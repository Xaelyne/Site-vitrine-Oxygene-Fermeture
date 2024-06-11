 <!-- Footer -->
 <?php
if ($action === "connexion") {
?>
<footer>


</footer>
<?php
} else {
?>
<footer class="monFooter ">
    <div class="p-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-6 g-3">
        <div class="col">
            <h6 class="fs-6 fw-bold">
                Adresse
            </h6>
            <p>
                <span>14 ter Rue Martincourt</span>
            </p>
            <p>
                <span>60112 Crillon</span>
            </p>
        </div>
        <div class="col">
            <h6 class="fs-6 fw-bold">
                Téléphone
            </h6>
            <p>
                <span>03.44.04.31.13</span>
            </p>
        </div>
        <div class="col">
            <h6 class="fs-6 fw-bold">
                Mail
            </h6>
            <p>
                <span class="fs-6">oxygenefermeture60@orange.fr</span>
            </p>
        </div>
        <div class="col">
            <h6 class="fs-6 fw-bold">
                <a class="text-decoration-none text-white" href="index.php?action=nousContacter">Nous contacter</a>
            </h6>
        </div>
        <div class="col">
            <a href="index.php?action=devis" class="btn bouton" role="button" aria-pressed="true">Votre devis gratuit en ligne</a>
        </div>
        <div class="col">
            <a href="#" class="btn bouton" role="button" data-bs-toggle="button" aria-pressed="true">Avis clients</a>
        </div>
        </div>
    </div>
</footer>
<?php 
} 
?> 
     
<?php if ($action === "nousContacter") { ?>
    <script src="./scripts/regexFormulaireContact.js"></script>
<?php } else if ($action === "devis") { ?>
    <script src="./scripts/regexFormulaireDevis.js"></script>
<?php } else if ($action === "accueil") { ?>
    <script src="./scripts/regexFormulaireContactAccueil.js"></script>
<?php } ?>

    <script src="./scripts/switch.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>