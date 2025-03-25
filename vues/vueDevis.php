<div class="container d-flex justify-content-center flex-column align-items-center">
    <div class="text-center mt-5 pt-4">
        <p class="fs-3 texte mb-5">
            Bienvenue sur notre page de demande de devis !  
        </p>
        <p class="fs-5 texte">
            Nous sommes ravis de vous assister dans la réalisation de votre projet.  
        </p>
        <p class="fs-5 texte">
            Veuillez remplir le formulaire ci-dessous
        </p>
        <p class="fs-5 texte">
            nous vous fournirons un devis personnalisé dans les plus brefs délais.
        </p>
    </div>
    <!-- Formulaire de devis -->
    <div class="divFormulaireContact my-5">
        <form method="POST" action="index.php" class="formulaire my-5" id="contactForm">
            <input type="hidden" name="action" value="traitement_formulaire_devis">
            <div class="container">
                <div class="row">
                    <div class="my-4 text-center">
                        <span class="text-white fs-1">
                            Demander votre devis en ligne gratuitement
                        </span>
                    </div>
                    <div class="mb-5 text-center">
                        <span class="text-danger" id="messageErreurEmailFormulaireDevis"></span>
                        <span class="text-danger" id="messageErreurNomFormulaireDevis"></span>
                        <span class="text-danger" id="messageErreurTelephoneFormulaireDevis"></span>
                        <span class="text-danger" id="messageErreurSujetFormulaireDevis"></span>
                        <span class="text-danger" id="messageErreurMessageFormulaireDevis"></span>
                    </div>
                    <div class="mb-3 col-xl-6">
                        <label for="nomFormulaireDevis" class="form-label text-white">Votre nom <span class="text-danger">(Obligatoire)</span></label>
                        <input type="text" class="form-control" id="nomFormulaireDevis" name="nomFormulaireDevis" required="required">
                    </div>
                    <div class="mb-3 col-xl-6">
                        <label for="telephoneFormulaireDevis" class="form-label text-white">Votre numéro de téléphone <span class="text-danger">(Obligatoire)</span></label>
                        <input type="tel" class="form-control" id="telephoneFormulaireDevis" name="telephoneFormulaireDevis" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12">
                        <label for="emailFormulaireDevis" class="form-label text-white">Votre adresse email <span class="text-danger">(Obligatoire)</span></label>
                        <input type="email" class="form-control" id="emailFormulaireDevis" name="emailFormulaireDevis" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12">
                        <label for="choixFormulaireDevis" class="form-label text-white">Choisissez le service dont vous avez besoin<span class="text-danger">(Obligatoire)</span></label>
                        <select class="form-select" name="choixFormulaireDevis" id="choixFormulaireDevis" required="required">
                        <option disabled selected="choisirUnService" value="">Choisissez votre service</option>
                        <?php foreach ($services as $serviceItem) { ?>
                        <option value="<?php echo $serviceItem['nom']; ?>"><?php echo $serviceItem['nom']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12">
                        <label for="sujetFormulaireDevis" class="form-label text-white">Sujet de votre message <span class="text-danger">(Obligatoire)</span></label>
                        <input type="text" class="form-control" id="sujetFormulaireDevis" name="sujetFormulaireDevis" required="required">
                    </div>
                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="messageFormulaireDevis" class="form-label text-white">Votre message <span class="text-danger">(Obligatoire)</span></label>
                        <textarea class="form-control messageFormulaire" id="messageFormulaireDevis" name="messageFormulaireDevis" rows="4" placeholder="Écrivez votre message ici" required="required" maxlength="500"></textarea>
                        <span class="text-white counter" ></span>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12 form-check mx-3">
                        <input type="checkbox" class="form-check-input" id="checkboxFormulaireDevis" required="required">
                        <label class="form-check-label text-white" for="checkboxFormulaireDevis">J’accepte la politique de confidentialité</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 d-flex justify-content-center">
                        <button type="submit" class="btn bouton" name="envoyer" id="boutonSubmitFormulaireDevis">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>