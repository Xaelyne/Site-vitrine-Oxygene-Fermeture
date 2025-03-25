var btnFormulaireAvis = document.getElementById('boutonSubmitFormulaireAvis');

btnFormulaireAvis.addEventListener('click',regexNomFormulaireAvis);
btnFormulaireAvis.addEventListener('click',regexMailFormulaireAvis);
btnFormulaireAvis.addEventListener('click',regexCommentaireFormulaireAvis);

function regexNomFormulaireAvis (e){
    var regex = /^[A-Za-zÀ-ÿà-ÿ]{2,}(?:[-\s][A-Za-zÀ-ÿà-ÿ]{2,})*$/;
    var email = document.getElementById("nomFormulaireAvis").value;
    var message = document.getElementById("messageErreurNomAvis")

    if (!regex.test(email)) {
        message.innerHTML = "Veuillez entrer un nom valide.<br>2 caractères minimum.<br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }
}

function regexMailFormulaireAvis (e){
    var regex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+.([a-zA-Z]{2,3})$/;
    var email = document.getElementById("emailFormulaireAvis").value;
    var message = document.getElementById("messageErreurEmailAvis")

    if (!regex.test(email)) {
        message.innerHTML = "Veuillez entrer une adresse email valide. <br> Par exemple : Abc123@exemple.com <br> <br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }
}

function regexCommentaireFormulaireAvis (e){
    var regex = /^(?=.{4,300}$)[^<>=]+$/;
    var messageForm = document.getElementById("messageFormulaireContactAccueil").value;
    var message = document.getElementById("messageErreurMessageContactAccueil")

    if (messageForm.length < 4) {
        message.innerHTML = "Votre message doit contenir au moins 4 caractères.";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else if (!regex.test(messageForm)) {
        message.innerHTML = "Veuillez entrer un message valide. <br> Il ne doit pas contenir de caractère spéciaux tel que <, > ou =";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }
}