<!-- Texte srur l'entreprise -->
<div class="container-fluid contenu d-flex justify-content-center flex-column align-items-center">
    <div class="text-center mt-5 pt-4" style="width: 60%;">
        <p class="fs-3 texte mb-5">
            Bienvenue chez Oxygene fermeture, votre spécialiste en solutions d'amélioration de l'habitat !
        </p>
        <p class="fs-5 texte">
            Nous sommes ravis de vous accueillir sur notre site internet.
        </p>
        <p class="fs-5 texte">
            Découvrez notre expertise en installation de fenêtres, velux, pergolas, et bien plus encore.
        </p>
        <p class="fs-5 texte">
            Explorez nos services variés et nos réalisations pour trouver l'inspiration et les solutions adaptées à vos projets d'aménagement.
        </p>
    </div>
<!-- Carte "Nos services" -->
    <div class=" text-center my-5" style="width: 13rem;">
        <p class="fs-4 texte petiteCarte py-2">Nos services</p>
    </div>
<!-- Cartes liste de services -->
    <div class="d-flex row row-cols-1 row-cols-md- g-4 d-flex justify-content-center align-items-center">
        <?php foreach ($services as $service) { ?>
            <!-- Carte pour chaque service -->
            <div class="card grandeCarte <?= isset($_SESSION['idUtilisateur']) ? 'grandeCarteAccueil' : '' ?> mb-5 text-white text-center mx-3" style="width: 10rem; height: 15rem;">
                <!-- Conteneur pour le bouton supprimer -->
                <?php if (isset($_SESSION['idUtilisateur'])): ?>
                    <div class="btn-supprimer-container">
                        <button class="btn-modifier boutonInverser" onclick="modifierService(event, <?= htmlspecialchars($service['id']); ?>)">Modifier</button>
                        <button class="btn-supprimer boutonInverser" onclick="supprimerService(event, <?= htmlspecialchars($service['id']); ?>)">Supprimer</button>
                    </div>
                <?php endif; ?>
                <!-- Lien autour de toute la carte qui dirige vers la page de détail du service si l'utilisateur n'est pas connecté -->
                <?php if (!isset($_SESSION['idUtilisateur'])): ?>
                    <a href="index.php?action=detailService&id=<?= htmlspecialchars($service['id']); ?>" class="lienCarte stretched-link">
                <?php endif; ?>
                        <!-- Image en haut de la carte -->
                        <img src="<?= htmlspecialchars($service['image']); ?>" class="card-img-top" alt="Service" style="width: 128px; height: 128px; object-fit: cover;">
                        <!-- Corps de la carte contenant le texte -->
                        <div class="card-body">
                            <!-- Texte du service -->
                            <p class="card-text"><?= htmlspecialchars($service['nom']); ?></p>
                        </div>
                <?php if (!isset($_SESSION['idUtilisateur'])): ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['idUtilisateur'])): ?>
            <!-- Carte pour ajouter un nouveau service si l'utilisateur est connecté -->
            <div class="card grandeCarteInverser mb-5 text-center mx-3" style="width: 10rem; height: 15rem;">
                <!-- Lien pour ajouter un nouveau service -->
                <a href="#" class="lienCarteInverser" onclick="ajouterService()">
                    <!-- Image d'un signe plus pour ajouter un service -->
                    <img src="./images/plus.png" class="card-img-top" alt="Ajouter Service">
                    <!-- Corps de la carte contenant le texte -->
                    <div class="card-body">
                        <!-- Texte indiquant l'ajout d'un nouveau service -->
                        <p class="card-text">Ajouter un nouveau service</p>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
<!-- Carte "Nos partenaire" -->
    <div class=" text-center my-5 " style="width: 13rem;">
        <p class="fs-4 texte petiteCarte py-2">Nos partenaires</p>
    </div>
<!-- Liste des partenaires -->
    <div class="d-flex flex-wrap justify-content-around">
        <?php foreach ($partenaires as $partenaire) { ?>
            <div class="card moyenneCarte mb-5 mx-1 text-center position-relative d-flex justify-content-center align-items-center" style="width: 17rem; height: 8rem;">
                <div class="overlay"></div>
                <?php if (isset($_SESSION['idUtilisateur'])): ?>
                    <div class="btn-supprimer-container">
                        <button class="btn-modifier boutonInverser" onclick="modifierPartenaire(event, <?= htmlspecialchars($partenaire['id']); ?>)">Modifier</button>
                        <button class="btn-supprimer boutonInverser" onclick="supprimerPartenaire(event, <?= htmlspecialchars($partenaire['id']); ?>)">Supprimer</button>
                    </div>
                <?php endif; ?>
                <a href="<?= !isset($_SESSION['idUtilisateur']) ? htmlspecialchars($partenaire['lien']) : '#' ?>" target="_blank" <?= isset($_SESSION['idUtilisateur']) ? 'style="pointer-events: none;"' : '' ?>>
                    <div class="card-body">
                        <img style="width: 250px; height: 100px;" src="<?= htmlspecialchars($partenaire['image']); ?>" alt="<?= htmlspecialchars($partenaire['nom']); ?>">
                    </div>
                </a>
            </div>
        <?php } ?>
        
        <?php if (isset($_SESSION['idUtilisateur'])): ?>
            <div class="card moyenneCarte mb-5 mx-1 text-center d-flex justify-content-center align-items-center" style="width: 17rem;">
                <a href="#" class="text-decoration-none" onclick="ajouterPartenaire()">
                    <div class="card-body">
                        <p class="texte fw-bold d-flex align-items-center justify-content-center">Ajouter un nouveau partenaire</p>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
<!-- Carte "Nous contacter" -->
    <div class=" text-center my-5 " style="width: 13rem;">
            <p class="fs-4 texte petiteCarte py-2">Nous contacter</p>
    </div>
    <div class="text-center">
        <p class="fs-5 texte">
            Nous sommes ici pour répondre à toutes vos questions et écouter vos suggestions. 
        </p>
        <p class="fs-5 texte pb-5">
            Veuillez remplir les champs ci-dessous et nous reviendrons vers vous dans les plus brefs délais.  
        </p>
        <p class="fs-5 texte">
            Vous pouvez également nous contacter directement 
        </p>
        <p class="fs-5 texte">
            Par email :
        </p>
        <p class="fs-5 texte">
            OxygeneFermeture60@orange.fr
        </p>
        <p class="fs-5 texte">
            Par téléphone :
        </p>
        <p class="fs-5 texte">
            03.44.04.31.13
        </p>
    </div>
    <!-- Formulaire de contact -->
    <div class="divFormulaireContact mt-5">
        <form method="POST" action="index.php" class="formulaire my-5" id="contactForm">
            <input type="hidden" name="action" value="traitement_formulaire_contact_accueil">
            <div class="container">
                <div class="row">
                    <div class="my-4 text-center">
                        <span class="text-white fs-1">
                            Contactez-nous
                        </span>
                    </div>
                    <div class="mb-5 text-center">
                        <span class="text-danger" id="messageErreurEmailContactAccueil"></span>
                        <span class="text-danger" id="messageErreurNomContactAccueil"></span>
                        <span class="text-danger" id="messageErreurTelephoneContactAccueil"></span>
                        <span class="text-danger" id="messageErreurSujetContactAccueil"></span>
                        <span class="text-danger" id="messageErreurMessageContactAccueil"></span>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nomFormulaireContactAccueil" class="form-label text-white">Votre nom <span class="text-danger">(Obligatoire)</span></label>
                        <input type="text" class="form-control" id="nomFormulaireContactAccueil" name="nomFormulaireContactAccueil" required="required">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="telephoneFormulaireContactAccueil" class="form-label text-white">Votre numéro de téléphone <span class="text-danger">(Obligatoire)</span></label>
                        <input type="tel" class="form-control" id="telephoneFormulaireContactAccueil" name="telephoneFormulaireContactAccueil" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="emailFormulaireContactAccueil" class="form-label text-white">Votre adresse email <span class="text-danger">(Obligatoire)</span></label>
                        <input type="email" class="form-control" id="emailFormulaireContactAccueil" name="emailFormulaireContactAccueil" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="sujetFormulaireContactAccueil" class="form-label text-white">Sujet de votre message <span class="text-danger">(Obligatoire)</span></label>
                        <input type="text" class="form-control" id="sujetFormulaireContactAccueil" name="sujetFormulaireContactAccueil" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="messageFormulaireContactAccueil" class="form-label text-white">Votre message <span class="text-danger">(Obligatoire)</span></label>
                        <textarea class="form-control messageFormulaire" id="messageFormulaireContactAccueil" name="messageFormulaireContactAccueil" rows="4" placeholder="Écrivez votre message ici" required="required" maxlength="500"></textarea>
                        <span class="text-white counter" ></span>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12 form-check mx-3">
                        <input type="checkbox" class="form-check-input" id="checkboxFormulaireContactAccueil" required="required">
                        <label class="form-check-label text-white" for="checkboxFormulaireContactAccueil">J’accepte la politique de confidentialité</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button type="submit" class="btn bouton" name="envoyer" id="boutonSubmitFormulaireContactAccueil">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<!-- Carte "Avis des clients" -->
    <div class=" text-center my-5 " style="width: 13rem;">
            <p class="fs-4 texte petiteCarte py-2">Avis des clients</p>
    </div>
</div>