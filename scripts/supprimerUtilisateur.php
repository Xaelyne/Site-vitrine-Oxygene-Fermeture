<script>
   function supprimerUtilisateur(id) {
        // Récupère l'ID de l'utilisateur actuellement connecté depuis la session PHP
        const currentUserId = <?php echo json_encode($_SESSION['idUtilisateur']); ?>;
        // Récupère l'élément HTML du tableau des utilisateurs
        const userTableBody = document.getElementById('userTableBody');

        // Vérifie si l'élément du tableau des utilisateurs existe
        if (!userTableBody) {
            console.error('Element with ID "userTableBody" not found.');
            return;
        }

        // Compte le nombre d'utilisateurs dans le tableau
        const userCount = userTableBody.querySelectorAll('tr').length;

        // Vérifie si l'utilisateur essaie de se supprimer lui-même
        if (id === currentUserId) {
            Swal.fire({
                title: 'Impossible!',
                text: 'Vous ne pouvez pas vous supprimer vous-même.',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'popup-btn'
                },
            });
            return;
        }
        
        // Vérifie s'il ne reste qu'un seul utilisateur dans le tableau
        if (userCount <= 1) {
            Swal.fire({
                title: 'Impossible!',
                text: 'Vous ne pouvez pas supprimer le dernier utilisateur restant.',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'popup-btn'
                },
            });
            return;
        }

        // Affiche une alerte de confirmation avant de supprimer l'utilisateur
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Cette action est irréversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler',
            customClass: {
                confirmButton: 'popup-btn',
                cancelButton: 'popup-annuler'
            },
        }).then((result) => {
            if (result.isConfirmed) {
                // Envoie une requête POST pour supprimer l'utilisateur
                fetch('index.php?action=supprimerUtilisateur', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Affiche une alerte de succès après la suppression
                        Swal.fire({
                            title: 'Supprimé!',
                            text: 'L\'utilisateur a été supprimé.',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            },

                        }).then(() => {
                            location.reload(); // Recharge la page après la suppression
                        });
                    } else {
                        // Affiche une alerte d'erreur si la suppression échoue
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
                    console.error('Error:', error);
                    // Affiche une alerte d'erreur en cas de problème avec la requête
                    Swal.fire({
                        title: 'Erreur!',
                        text: 'Une erreur est survenue lors du traitement de la réponse',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'popup-btn'
                        },
                    });
                });
            }
        });
    }
</script>