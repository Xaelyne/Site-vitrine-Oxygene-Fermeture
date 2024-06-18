<?php
// Fonction pour vérifier si une chaîne commence par une voyelle
    function commenceParVoyelle($chaine) {
        // Retourne vrai si la première lettre de la chaîne (en minuscule) est une voyelle (y compris les voyelles accentuées)
        return in_array(mb_strtolower(mb_substr($chaine, 0, 1)), ['a', 'e', 'i', 'o', 'u', 'y', 'é', 'è', 'ê']);
    }

    // Vérifie si la variable $service est définie
    if (isset($service)) {
        // Détermine le préfixe à utiliser ("d'" si le nom du service commence par une voyelle, "de " sinon)
        $prefixe = commenceParVoyelle($service['nom']) ? "d'" : "de ";
        ?>
        <div class="container d-flex justify-content-center flex-column align-items-center">
            <!-- Section de texte principale -->
            <div class="text-center mt-5 pt-4" style="width: 60%;">
                <p class="fs-3 texte mb-5">
                    Découvrez notre service <?= $prefixe . htmlspecialchars(lcfirst($service['nom'])); ?> !
                </p>
                <p class="fs-5 texte">
                    Explorez ci-dessous pour en savoir plus sur ce que notre service <?= $prefixe . htmlspecialchars(lcfirst($service['nom'])); ?> peut vous offrir.
                </p>
                <p class="fs-5 texte">
                    Pour toute question, n'hésitez pas à nous contacter.
                </p>
            </div>
            <!-- Section pour afficher une carte avec l'image et le nom du service -->
            <div class="d-flex row row-cols-1 row-cols-md- g-4 d-flex justify-content-center align-items-center my-5">
                <div class="card grandeCarte mb-5 text-white text-center mx-3" style="width: 10rem; height: 15rem;">
                    <a class="lienCarte">
                        <img src="<?= htmlspecialchars($service['image']); ?>" class="card-img-top" alt="Service" style="width: 128px; height: 128px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text "><?= htmlspecialchars(ucfirst($service['nom'])); ?></p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Section pour afficher les détails du service -->
            <div class="mb-5">
                <ul>
                    <?php if (!empty($service['details'])): ?>
                        <?php foreach ($service['details'] as $detail): ?>
                            <li class="texte fs-5"><?= htmlspecialchars(ucfirst($detail)); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="texte fs-5">Aucun détail disponible pour ce service.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- Bouton pour voir les réalisations du service -->
            <div class="my-5 pb-5">
                <a href="index.php?action=realisationService&id=<?= htmlspecialchars($service['id']); ?>" class="btn boutonInverser" role="button" aria-pressed="true">Voir nos réalisations pour <?= htmlspecialchars(lcfirst($service['nom'])); ?></a>
            </div>
        </div>
    <?php } else { ?>
        <!-- Message affiché si le service n'est pas trouvé -->
        <p>Service non trouvé.</p>
    <?php } ?>