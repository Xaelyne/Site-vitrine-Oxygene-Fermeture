<div class="container d-flex justify-content-center flex-column align-items-center">
    <div class="text-center mt-5 pt-4">
        <p class="fs-3 texte mb-5">
            Bienvenue sur notre formulaire de contact !  
        </p>
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
            oxygenefermeture60@orange.fr
        </p>
        <p class="fs-5 texte">
            Par téléphone :
        </p>
        <p class="fs-5 texte">
            <span><?= htmlspecialchars($infoEntreprise['telephoneEntreprise']); ?></span>
        </p>
    </div>
    <!-- Formulaire de contact -->
    <div class="divFormulaireContact my-5">
        <form method="POST" action="index.php" class="formulaire my-5" id="contactForm">
            <input type="hidden" name="action" value="traitement_formulaire_contact">
            <div class="container">
                <div class="row">
                    <div class="my-4 text-center">
                        <span class="text-white fs-1">
                            Contactez-nous
                        </span>
                    </div>
                    <div class="mb-5 text-center">
                        <span class="text-danger" id="messageErreurEmailContact"></span>
                        <span class="text-danger" id="messageErreurNomContact"></span>
                        <span class="text-danger" id="messageErreurTelephoneContact"></span>
                        <span class="text-danger" id="messageErreurSujetContact"></span>
                        <span class="text-danger" id="messageErreurMessageContact"></span>
                    </div>
                    <div class="mb-3 col-xl-6">
                        <label for="nomFormulaireContact" class="form-label text-white">Votre nom <span class="text-danger">(Obligatoire)</span></label>
                        <input type="text" class="form-control" id="nomFormulaireContact" name="nomFormulaireContact" required="required">
                    </div>
                    <div class="mb-3 col-xl-6">
                        <label for="telephoneFormulaireContact" class="form-label text-white">Votre numéro de téléphone <span class="text-danger">(Obligatoire)</span></label>
                        <input type="tel" class="form-control" id="telephoneFormulaireContact" name="telephoneFormulaireContact" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12">
                        <label for="emailFormulaireContact" class="form-label text-white">Votre adresse email <span class="text-danger">(Obligatoire)</span></label>
                        <input type="email" class="form-control" id="emailFormulaireContact" name="emailFormulaireContact" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12">
                        <label for="sujetFormulaireContact" class="form-label text-white">Sujet de votre message <span class="text-danger">(Obligatoire)</span></label>
                        <input type="text" class="form-control" id="sujetFormulaireContact" name="sujetFormulaireContact" required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12">
                        <label for="messageFormulaireContact" class="form-label text-white">Votre message <span class="text-danger">(Obligatoire)</span></label>
                        <textarea class="form-control messageFormulaire" id="messageFormulaireContact" name="messageFormulaireContact" rows="4" placeholder="Écrivez votre message ici" required="required" maxlength="500"></textarea>
                        <span class="text-white counter"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-xl-12 form-check mx-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required="required">
                        <label class="form-check-label text-white" for="exampleCheck1">J’accepte la politique de confidentialité</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 d-flex justify-content-center">
                        <button type="submit" class="btn bouton" name="envoyer" id="boutonSubmitForm">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>