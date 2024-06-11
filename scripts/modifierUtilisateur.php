<script>
    function modifierUtilisateur(id) {
        // Obtenir les informations de l'utilisateur à partir du tableau HTML en utilisant l'ID de l'utilisateur
        const utilisateur = {
            id: id,
            nom: document.querySelector(`tr[data-id="${id}"] td:nth-child(1)`).innerText,
            prenom: document.querySelector(`tr[data-id="${id}"] td:nth-child(2)`).innerText,
            email: document.querySelector(`tr[data-id="${id}"] td:nth-child(3)`).innerText
        };

        // Utiliser SweetAlert2 pour afficher un formulaire de modification d'utilisateur
        Swal.fire({
            title: 'Modifier Utilisateur', // Titre de la fenêtre
            html: `
                <input type="hidden" id="idUtilisateur" value="${utilisateur.id}"> <!-- Champ caché pour l'ID utilisateur -->
                <input type="text" id="nomUtilisateur" class="swal2-input" placeholder="Nom" value="${utilisateur.nom}"> <!-- Champ pour le nom -->
                <input type="text" id="prenomUtilisateur" class="swal2-input" placeholder="Prénom" value="${utilisateur.prenom}"> <!-- Champ pour le prénom -->
                <input type="email" id="emailUtilisateur" class="swal2-input" placeholder="Email" value="${utilisateur.email}"> <!-- Champ pour l'email -->
                <input type="password" id="mdpUtilisateur" class="swal2-input" placeholder="Mot de passe"> <!-- Champ pour le mot de passe -->
                <input type="password" id="confirmMdpUtilisateur" class="swal2-input" placeholder="Confirmer Mot de passe"> <!-- Champ pour confirmer le mot de passe -->
            `,
            confirmButtonText: 'Modifier', // Texte du bouton de confirmation
            customClass: {
                confirmButton: 'popup-btn' // Classe CSS personnalisée pour le bouton de confirmation
            },
            focusConfirm: false, // Ne pas focus automatiquement sur le bouton de confirmation
            preConfirm: () => { // Fonction exécutée avant la confirmation
                // Récupérer les valeurs des champs du formulaire afin de pré remplir le formulaire
                const id = Swal.getPopup().querySelector('#idUtilisateur').value;
                const nom = Swal.getPopup().querySelector('#nomUtilisateur').value;
                const prenom = Swal.getPopup().querySelector('#prenomUtilisateur').value;
                const email = Swal.getPopup().querySelector('#emailUtilisateur').value;
                const mdp = Swal.getPopup().querySelector('#mdpUtilisateur').value;
                const confirmMdp = Swal.getPopup().querySelector('#confirmMdpUtilisateur').value;

                // Validation des champs
                if (!nomValide(nom)) {
                    Swal.showValidationMessage('Nom invalide'); // Afficher un message d'erreur si le nom est invalide grâce au regex
                    return false;
                }

                if (!nomValide(prenom)) {
                    Swal.showValidationMessage('Prénom invalide'); // Afficher un message d'erreur si le prénom est invalide grâce au regex
                    return false;
                }

                if (!emailValide(email)) {
                    Swal.showValidationMessage('Adresse email invalide'); // Afficher un message d'erreur si l'email est invalide grâce au regex
                    return false;
                }

                if (mdp !== confirmMdp) {
                    Swal.showValidationMessage('Les mots de passe ne correspondent pas'); // Afficher un message d'erreur si les mots de passe ne correspondent pas
                    return false;
                }
                // Vérifier si des modifications ont été effectuées
                if (nom === utilisateur.nom && prenom === utilisateur.prenom && email === utilisateur.email && mdp === '') {
                    return null; // Aucune modification n'a été faite
                }

                // Retourner les données de l'utilisateur si toutes les validations sont réussies
                return { id, nom, prenom, email, mdp };
            }
        }).then((result) => { // Fonction exécutée après la confirmation
                // Si aucune modification n'a été faite
                if (result.value === null) {
                    Swal.fire({
                        title: 'Pas de modification',
                        text: 'Aucune modification n\'a été effectuée',
                        icon: 'info',
                        customClass: {
                            confirmButton: 'popup-btn' // Applique la classe CSS personnalisée au bouton de confirmation
                        }
                    });
                }else if (result.isConfirmed) { // Si l'utilisateur a confirmé
                    // Envoyer les données au contrôleur via AJAX
                    const data = result.value;
                    fetch('index.php?action=modifierUtilisateur', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json' // Spécifier que les données envoyées sont en JSON
                        },
                        body: JSON.stringify(data) // Convertir les données en chaîne JSON
                    }).then(response => response.text()) // Lire la réponse brute du serveur
                    .then(responseText => {
                        console.log(responseText); // Afficher la réponse brute dans la console pour débogage
                        return JSON.parse(responseText); // Convertir la réponse en objet JSON
                    })
                    .then(data => {
                        if (data.success) { // Si la modification a réussi
                            Swal.fire({
                                title: 'Modifié!',
                                text: 'Utilisateur modifié avec succès',
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'popup-btn' // Applique la classe CSS personnalisée au bouton de confirmation
                                }  
                            }).then(() => {
                                location.reload(); // Recharger la page pour voir les modifications
                            });
                        } else { // Si la modification a échoué
                            Swal.fire({
                                title: 'Erreur!',
                                text: data.message || 'Une erreur est survenue',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'popup-btn' // Applique la classe CSS personnalisée au bouton de confirmation
                                }  
                            });
                        }
                    })
                    .catch(error => { // Gérer les erreurs de réseau ou de serveur
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Une erreur est survenue lors du traitement de la réponse',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'popup-btn' // Applique la classe CSS personnalisée au bouton de confirmation
                            }  
                        });
                    });
                }
            });
    }

    // Fonction pour valider les noms et prénoms
    function nomValide(name) {
        const regex = /^[A-Za-zéè'-]*$/; // Expression régulière pour vérifier que le nom contient seulement des lettres, accents et certains caractères spéciaux
        return regex.test(name); // Retourne vrai si le nom est valide, faux sinon
    }

    // Fonction pour valider l'email
    function emailValide(email) {
        const regex = /^[a-zA-Z0-9](\w\.?)*[a-zA-Z0-9]@[a-zA-Z0-9]+\.[a-zA-Z]{2,6}$/; // Expression régulière pour vérifier la validité de l'email
        return regex.test(email); // Retourne vrai si l'email est valide, faux sinon
    }
</script>