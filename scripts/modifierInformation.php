<script>
   
   document.getElementById('formModifierInformationsEntreprise').addEventListener('submit', function(e) {
    e.preventDefault();

    // Regex
    const regexTelephone = /^(?:0|\+33)[1-9](?:[\s.-]*\d{2}){4}$/;
    const regexAdresse = /^[\w\s-]+$/; // Adresse: lettres, chiffres, espaces, tirets
    const regexCodePostal = /^\d{5}$/; // Code postal: uniquement 5 chiffres
    const regexVille = /^[A-Za-zÀ-ÖØ-öø-ÿ\s-]+$/;

    // Valeurs des champs
    let telephone = document.getElementById('telephone').value.trim();
    let adresse = document.getElementById('adresse').value.trim();
    let codePostal = document.getElementById('codePostal').value.trim();
    let ville = document.getElementById('ville').value.trim();

    // Spans d'erreur
    const erreurTelephone = document.getElementById('messageErreurTelInfosEntreprise');
    const erreurAdresse = document.getElementById('messageErreurAdresseInfosEntreprise');
    const erreurCodePostal = document.getElementById('messageErreurCodePostalInfosEntreprise');
    const erreurVille = document.getElementById('messageErreurVilleInfosEntreprise');

    // Effacer les erreurs précédentes
    erreurTelephone.textContent = '';
    erreurAdresse.textContent = '';
    erreurCodePostal.textContent = '';
    erreurVille.textContent = '';

    // Indicateur de validation
    let estValide = true;

    // Valider et formater le téléphone
    if (telephone && !regexTelephone.test(telephone.replace(/\./g, ''))) {
        erreurTelephone.textContent = 'Numéro de téléphone invalide.';
        estValide = false;
    } else if (telephone) {
        // Ajouter les points tous les deux chiffres
        telephone = telephone.replace(/(\d{2})(?=\d)/g, '$1.');
        document.getElementById('telephone').value = telephone;
    }

    // Valider l'adresse
    if (adresse && !regexAdresse.test(adresse)) {
        erreurAdresse.textContent = 'Adresse invalide. Elle peut contenir des lettres, chiffres, espaces et tirets.';
        estValide = false;
    } else if (adresse) {
        // Formater l'adresse
        adresse = capitalizeAddress(adresse);
        document.getElementById('adresse').value = adresse;
    }

    // Valider le code postal
    if (codePostal && !regexCodePostal.test(codePostal)) {
        erreurCodePostal.textContent = 'Code postal invalide. Il doit contenir exactement 5 chiffres.';
        estValide = false;
    }

    // Valider la ville
    if (ville && !regexVille.test(ville)) {
        erreurVille.textContent = 'Ville invalide. Elle ne doit contenir que des lettres et des tirets.';
        estValide = false;
    } else if (ville) {
        // Formater la ville
        ville = capitalizeFirstLetter(ville);
        document.getElementById('ville').value = ville;
    }

    if (estValide) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Voulez-vous vraiment valider les modifications?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, valider!',
            cancelButtonText: 'Annuler',
            customClass: {
                confirmButton: 'popup-btn',
                cancelButton: 'popup-annuler'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = {
                    telephone: telephone || null,
                    adresse: adresse || null,
                    codePostal: codePostal || null,
                    ville: ville || null
                };

                fetch('index.php?action=modifierInformationsEntreprise', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Succès!',
                            text: 'Les informations ont été mises à jour avec succès.',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Une erreur est survenue lors de la mise à jour.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    Swal.fire({
                        title: 'Erreur!',
                        text: 'Une erreur est survenue lors de la communication avec le serveur.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'popup-btn'
                        }
                    });
                });
            }
        });
    }
});

function capitalizeFirstLetter(string) {
    return string.replace(/\b\w/g, char => char.toUpperCase());
}

function capitalizeAddress(string) {
    return string.replace(/\b(\w)/g, char => char.toUpperCase());
}
</script>
