<div class="container d-flex justify-content-center flex-column align-items-center">
    <div class="text-center mt-5 pt-4" style="width: 60%;">
        <p class="fs-3 texte mb-5">
            Bienvenue sur notre page de services !  
        </p>
        <p class="fs-5 texte">
            Nous sommes fiers de vous présenter la gamme complète de services que nous offrons pour répondre à tous vos besoins.
        </p>
        <p class="fs-5 texte">
            Notre équipe d'experts est là pour vous fournir des solutions personnalisées et de haute qualité.
        </p>
        <p class="fs-5 texte">
            Explorez nos services ci-dessous et n'hésitez pas à nous contacter pour toute question ou pour obtenir un devis personnalisé.
        </p>
    </div>
    <div class="d-flex row row-cols-1 row-cols-md- g-4 d-flex justify-content-center align-items-center my-5">
        <?php foreach ($services as $service) { ?>
            <!-- Carte pour chaque service -->
            <div class="card grandeCarte mb-5 text-white text-center mx-3" style="width: 10rem; height: 15rem;">
                <!-- Lien autour de toute la carte qui dirige vers la page de détail du service -->
                <a href="index.php?action=detailService&id=<?= htmlspecialchars($service['id']); ?>" class="lienCarte stretched-link">
                    <!-- Image en haut de la carte -->
                    <img src="<?= htmlspecialchars($service['image']); ?>" class="card-img-top" alt="Service" style="width: 128px; height: 128px; object-fit: cover;">
                    <!-- Corps de la carte contenant le texte -->
                    <div class="card-body">
                        <!-- Texte du service -->
                        <p class="card-text"><?= htmlspecialchars($service['nom']); ?></p>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>