<div class="container-fluid contenu d-flex justify-content-center flex-column align-items-center">
    <div class="text-center mt-5 pt-4" style="width: 60%;">
        <p class="fs-3 texte mb-5">
            Découvrez nos réalisations de toutes nos poses !
        </p>
        <p class="fs-5 texte">
            Explorez notre galerie de projets terminés avec succès.
        </p>
        <p class="fs-5 texte">
            Chaque installation témoigne de notre expertise et de notre engagement envers la satisfaction du client.
        </p>
        <p class="fs-5 texte">
            Laissez-vous inspirer par nos réalisations et imaginez les possibilités pour embellir votre espace.
        </p>
        <?php if (isset($_SESSION['idUtilisateur'])) { ?>
            <div class="d-flex justify-content-center align-items-center mt-5">
                <div class="card grandeCartePhoto text-white text-center mt-5 py-2 px-2 mx-3" style="width: 370px; cursor: pointer; margin-bottom: 20px;" onclick="ajouterRealisation()">
                    <div class="card-body d-flex align-items-center justify-content-center" style="height: 300px;">
                        <span class="fs-3">Ajouter une nouvelle photo</span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="gallery d-flex row row-cols-1 row-cols-md- g-4 d-flex justify-content-center align-items-center my-5">
        <?php foreach ($toutesRealisations as $realisation) { ?>
            <div class="card grandeCartePhoto my-5 text-white text-center py-2 px-2 mx-3 position-relative <?php if (isset($_SESSION['idUtilisateur'])) echo 'logged-in'; ?>" style="width: 370px;">
                <?php if (isset($_SESSION['idUtilisateur'])) { ?>
                    <div class="btn-supprimer-container">
                        <button class="btn-modifier" onclick="modifierRealisation(<?= $realisation['identifiantRealisation'] ?>)">Modifier</button>
                        <button class="btn-supprimer" onclick="supprimerRealisation(<?= $realisation['identifiantRealisation'] ?>)">Supprimer</button>
                    </div>
                <?php } ?>
                <a href="<?= htmlspecialchars($realisation['imageRealisation']); ?>" class="photoCarte" data-lightbox="mygallery" <?php if (isset($_SESSION['idUtilisateur'])) echo 'onclick="event.preventDefault()"'; ?>>
                    <img src="<?= htmlspecialchars($realisation['imageRealisation']); ?>" class="card-img" style="width: 350px; height: 300px;" alt="<?= htmlspecialchars($realisation['nomRealisation']); ?>">
                </a>
            </div>
        <?php } ?>
    </div>
    <?php if (count($toutesRealisations) >= 10) { ?>
        <button id="voirPlusBtn" class="btn boutonInverser mb-5" onclick="voirPlus()">Voir plus</button>
    <?php } ?>
</div>