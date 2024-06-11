<script>
   function supprimerUtilisateur(id) {
        const currentUserId = <?php echo json_encode($_SESSION['idUtilisateur']); ?>;
        const userTableBody = document.getElementById('userTableBody');

        if (!userTableBody) {
            console.error('Element with ID "userTableBody" not found.');
            return;
        }

        const userCount = userTableBody.querySelectorAll('tr').length;

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
                fetch('index.php?action=supprimerUtilisateur', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Supprimé!',
                            text: 'L\'utilisateur a été supprimé.',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'popup-btn'
                            },
 
                        }).then(() => {
                            location.reload();
                        });
                    } else {
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