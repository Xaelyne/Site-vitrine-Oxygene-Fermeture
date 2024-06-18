<div class="container-fluid d-flex justify-content-center flex-column align-items-center">
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <div class="text-center my-5 pt-4" style="width: 60%;">
            <p class="fs-3 texte mb-5">
                Bienvenue sur notre page d'avis clients !
            </p>
            <p class="fs-5 texte">
                Lisez ce que nos clients disent de nous et partagez votre propre expérience.
            </p>
            <p class="fs-5 texte">
                Nous apprécions vos retours et nous nous efforçons constamment d'améliorer nos services.
            </p>
        </div>
        <div id="avisContainer" class="row justify-content-center">
            <?php foreach ($avis as $avi) { ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card carteAvis p-3 text-center position-relative moyenneCarte">
                        <div class="d-flex flex-column align-items-center mb-2">
                            <h5 class="me-2"><?= htmlspecialchars($avi['prenomClientAvis']); ?></h5>
                            <div class="stars d-flex">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $avi['etoileAvis']) {
                                        echo '<img src="images/etoileRemplie.png" alt="Étoile remplie" style="width: 24px;">';
                                    } else {
                                        echo '<img src="images/etoileVide.png" alt="Étoile vide" style="width: 24px;">';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <p><?= nl2br(htmlspecialchars($avi['commentaireAvis'])); ?></p>
                        <?php if (isset($_SESSION['idUtilisateur'])) { ?>
                            <div class="overlay"></div>
                            <div class="btn-supprimer-container">
                            <button class="btn-modifier" onclick="modifierAvis(<?= $avi['identifiantAvis'] ?>, '<?= htmlspecialchars($avi['prenomClientAvis']) ?>', <?= $avi['etoileAvis'] ?>, '<?= htmlspecialchars($avi['commentaireAvis']) ?>')">Modifier</button>
                                <button class="btn-supprimer" onclick="supprimerAvis(<?= $avi['identifiantAvis']; ?>)">Supprimer</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if (count($avis) >= 10) { ?>
            <button id="voirPlusBtn" class="btn boutonInverser mb-5" onclick="voirPlusAvis()">Voir plus</button>
        <?php } ?>
        <?php if (isset($_SESSION['idUtilisateur'])) { ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card carteAvis p-3 text-center" style="cursor: pointer;" onclick="ajouterAvis()">
                    <div class="d-flex flex-column align-items-center mb-2">
                        <h5 class="me-2">Ajouter un nouvel avis</h5>
                        <div class="stars d-flex">
                            <img src="images/etoileVide.png" alt="Étoile vide" style="width: 24px;">
                            <img src="images/etoileVide.png" alt="Étoile vide" style="width: 24px;">
                            <img src="images/etoileVide.png" alt="Étoile vide" style="width: 24px;">
                            <img src="images/etoileVide.png" alt="Étoile vide" style="width: 24px;">
                            <img src="images/etoileVide.png" alt="Étoile vide" style="width: 24px;">
                        </div>
                    </div>
                    <p>Cliquez ici pour ajouter un avis</p>
                </div>
            </div>
        <?php } ?>
        <div class="mt-5">
            <p class="fs-5 texte">
                Remplissez le formulaire ci-dessous pour laisser votre avis.
            </p>
        </div>
        <div class="divFormulaireContact my-5">
            <form method="POST" action="index.php" class="formulaire my-5" id="contactForm">
                <input type="hidden" name="action" value="traitement_formulaire_avis">
                <div class="container">
                    <div class="row">
                        <div class="my-4 text-center">
                            <span class="text-white fs-1">
                                Donnez votre avis
                            </span>
                        </div>
                        <div class="mb-5 text-center">
                            <span class="text-danger" id="messageErreurNomAvis"></span>
                            <span class="text-danger" id="messageErreurCommentaireAvis"></span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nomFormulaireAvis" class="form-label text-white">Votre prénom</label>
                            <input type="text" class="form-control" id="nomFormulaireAvis" name="nomFormulaireAvis" placeholder="Votre prénom" required="required">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="emailFormulaireAvis" class="form-label text-white">Votre adresse email</label>
                            <input type="email" class="form-control" id="emailFormulaireAvis" name="emailFormulaireAvis" placeholder="Votre adresse email" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label text-white">Votre note</label>
                            <div id="rating" class="d-flex">
                                <img src="images/etoileVide.png" class="star" data-value="1" style="width: 24px; cursor: pointer;">
                                <img src="images/etoileVide.png" class="star" data-value="2" style="width: 24px; cursor: pointer;">
                                <img src="images/etoileVide.png" class="star" data-value="3" style="width: 24px; cursor: pointer;">
                                <img src="images/etoileVide.png" class="star" data-value="4" style="width: 24px; cursor: pointer;">
                                <img src="images/etoileVide.png" class="star" data-value="5" style="width: 24px; cursor: pointer;">
                            </div>
                            <input type="hidden" name="noteFormulaireAvis" id="noteFormulaireAvis" value="0" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="commentaireFormulaireAvis" class="form-label text-white">Votre commentaire</label>
                            <textarea class="form-control commentaireFormulaireAvis" id="commentaireFormulaireAvis" name="commentaireFormulaireAvis" rows="4" placeholder="Votre commentaire" required="required" maxlength="300"></textarea>
                            <span class="text-white counter" ></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12 form-check mx-3">
                            <input type="checkbox" class="form-check-input" id="checkboxFormulaireAvis" required="required">
                            <label class="form-check-label text-white" for="checkboxFormulaireAvis">J’accepte la politique de confidentialité</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn bouton" name="envoyer" id="boutonSubmitFormulaireAvis">Envoyer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>