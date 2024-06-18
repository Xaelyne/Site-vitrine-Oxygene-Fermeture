<script>

    function supprimerAvis(idAvis) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas annuler cette action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler',
            customClass: {
                confirmButton: 'popup-btn',
                cancelButton: 'popup-annuler'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`index.php?action=supprimerAvis&id=${idAvis}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Supprimé!',
                                text: 'L\'avis a été supprimé.',
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
                                text: data.message || 'Une erreur est survenue lors de la suppression.',
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

</script>