<div class="container d-flex justify-content-center flex-column align-items-center">
    <div class="text-center mt-5 pt-4" style="width: 60%;">
        <p class="fs-3 texte mb-5">
            Découvrez nos réalisations de <?= htmlspecialchars($service['nom']); ?> !
        </p>
    </div>
    <div class="gallery d-flex row row-cols-1 row-cols-md- g-4 d-flex justify-content-center align-items-center my-5">
        <?php foreach ($realisations as $realisation) { ?>
            <div class="card grandeCartePhotoDetail my-5 text-white text-center py-2 px-2 mx-3" style="width: 370px;">
                <a href="<?= htmlspecialchars($realisation['imageRealisation']); ?>" class="photoCarte" data-lightbox="mygallery">
                    <img src="<?= htmlspecialchars($realisation['imageRealisation']); ?>" class="card-img" style="width: 350px; height: 300px;" alt="<?= htmlspecialchars($realisation['nomRealisation']); ?>">
                </a>
            </div>
        <?php } ?>
    </div>
    <?php if ($offset + count($realisations) < $totalRealisations) { ?>
        <button id="voirPlusBtn" class="btn boutonInverser mb-5" onclick="voirPlusParService(<?= $service['id'] ?>)">Voir plus</button>
    <?php } ?>
</div>