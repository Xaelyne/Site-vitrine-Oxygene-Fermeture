function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    // Obtenir tous les éléments ayant la classe "tabcontent" (le contenu des onglets)
    tabcontent = document.getElementsByClassName("tabcontent");

    // Boucle à travers tous les éléments "tabcontent" pour les masquer
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none"; // Masquer chaque contenu d'onglet
    }

    // Obtenir tous les éléments ayant la classe "tablinks" (les boutons des onglets)
    tablinks = document.getElementsByClassName("tablinks");

    // Boucle à travers tous les éléments "tablinks" pour supprimer la classe "active"
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", ""); // Supprimer la classe "active"
    }

    // Afficher l'onglet correspondant en utilisant son ID
    document.getElementById(tabName).style.display = "block";

    // Ajouter la classe "active" au bouton de l'onglet cliqué
    evt.currentTarget.className += " active";
}