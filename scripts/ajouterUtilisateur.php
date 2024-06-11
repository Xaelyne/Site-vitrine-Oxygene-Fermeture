<script>

    function ajouterUtilisateur() {
        // Crée un formulaire SweetAlert pour ajouter un nouvel utilisateur
        Swal.fire({
            title: 'Ajouter un nouvel utilisateur', // Titre du formulaire
            html: `
                <form id="addUserForm">
                    <input type="text" id="nomUtilisateur" class="swal2-input" placeholder="Nom">
                    <input type="text" id="prenomUtilisateur" class="swal2-input" placeholder="Prénom">
                    <input type="email" id="emailUtilisateur" class="swal2-input" placeholder="Email">
                    <input type="password" id="mdpUtilisateur" class="swal2-input" placeholder="Mot de passe">
                    <input type="password" id="confirmMdpUtilisateur" class="swal2-input" placeholder="Confirmer Mot de passe">
                </form>
            `, // Contenu HTML de la boîte de dialogue, un formulaire avec des champs pour les informations de l'utilisateur
            confirmButtonText: 'Ajouter', // Texte du bouton de confirmation
            focusConfirm: false, // Ne pas mettre le focus automatiquement sur le bouton de confirmation
            customClass: {
                confirmButton: 'popup-btn' // Classe CSS personnalisée pour le bouton de confirmation
            },
            preConfirm: () => {
                // Récupère les valeurs des champs du formulaire
                const nom = Swal.getPopup().querySelector('#nomUtilisateur').value;
                const prenom = Swal.getPopup().querySelector('#prenomUtilisateur').value;
                const email = Swal.getPopup().querySelector('#emailUtilisateur').value;
                const mdp = Swal.getPopup().querySelector('#mdpUtilisateur').value;
                const confirmMdp = Swal.getPopup().querySelector('#confirmMdpUtilisateur').value;

                // Validation des champs
                if (!nom || !prenom || !email || !mdp || !confirmMdp) {
                    Swal.showValidationMessage('Tous les champs sont requis'); // Message d'erreur si un champ est vide
                    return false;
                }

                if (!nomValide(nom)) {
                    Swal.showValidationMessage('Nom invalide'); // Message d'erreur si le nom est invalide
                    return false;
                }

                if (!nomValide(prenom)) {
                    Swal.showValidationMessage('Prénom invalide'); // Message d'erreur si le prénom est invalide
                    return false;
                }

                if (!emailValide(email)) {
                    Swal.showValidationMessage('Adresse email invalide'); // Message d'erreur si l'email est invalide
                    return false;
                }

                if (mdp !== confirmMdp) {
                    Swal.showValidationMessage('Les mots de passe ne correspondent pas'); // Message d'erreur si les mots de passe ne correspondent pas
                    return false;
                }

                // Capitaliser la première lettre des noms et prénoms
                const capitalizedNom = capitalizeFirstLetter(nom);
                const capitalizedPrenom = capitalizeFirstLetter(prenom);

                // Retourne les données validées pour l'envoi
                return { nom: capitalizedNom, prenom: capitalizedPrenom, email, mdp };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Si l'utilisateur confirme, envoie les données au serveur via une requête AJAX
                const data = result.value;
                fetch('index.php?action=ajouterUtilisateur', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data) // Convertit les données en JSON
                }).then(response => response.json()) // Parse la réponse du serveur en JSON
                .then(data => {
                    if (data.success) {
                        // Si l'ajout a réussi, affiche un message de succès et recharge la page
                        Swal.fire({
                            title: 'Ajouté!',
                            text: 'Le nouvel utilisateur a été ajouté avec succès',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        // Si une erreur survient, affiche un message d'erreur
                        Swal.fire({
                            title: 'Erreur!',
                            text: data.message || 'Une erreur est survenue',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            }
                        });
                    }
                })
                .catch(error => {
                    // Si une erreur survient lors de la requête AJAX, affiche un message d'erreur
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Erreur!',
                        text: 'Une erreur est survenue lors du traitement de la réponse',
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

    // Fonction pour capitaliser la première lettre
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }


</script>