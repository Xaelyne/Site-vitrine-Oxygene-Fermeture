//REGEX POUR LE FORMULAIRE PAGE D'ACCUEIL
var btnFormulaireContactAccueil = document.getElementById('boutonSubmitFormulaireContactAccueil');

btnFormulaireContactAccueil.addEventListener("click",regexEmailFormulaireContactAccueil);
btnFormulaireContactAccueil.addEventListener("click",regexNomFormulaireContactAccueil);
btnFormulaireContactAccueil.addEventListener("click",regexTelephoneFormulaireContactAccueil);
btnFormulaireContactAccueil.addEventListener("click",regexSujetFormulaireContactAccueil);
btnFormulaireContactAccueil.addEventListener("click",regexMessageFormFormulaireContactAccueil);


//Regex Email

function regexEmailFormulaireContactAccueil(e){
    var regex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+.([a-zA-Z]{2,3})$/;
    var email = document.getElementById("emailFormulaireContactAccueil").value;
    var message = document.getElementById("messageErreurEmailContactAccueil")

    if (!regex.test(email)) {
        message.innerHTML = "Veuillez entrer une adresse email valide. <br> Par exemple : Abc123@exemple.com <br> <br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}

//Regex Nom

function regexNomFormulaireContactAccueil(e){
    var regex = /^[A-Za-zÀ-ÿà-ÿ]{2,}(?:[-\s][A-Za-zÀ-ÿà-ÿ]{2,})*$/;
    var nom = document.getElementById("nomFormulaireContactAccueil").value;
    var message = document.getElementById("messageErreurNomContactAccueil")

    if (!regex.test(nom)) {
        message.innerHTML = "Veuillez entrer un nom valide.<br>2 caractères minimum.<br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}

//Regex Téléphone

function regexTelephoneFormulaireContactAccueil(e){
    var regex = /^(?:0|\+33)[1-9](?:[\s.-]*\d{2}){4}$/;
    var tel= document.getElementById("telephoneFormulaireContactAccueil").value;
    var message = document.getElementById("messageErreurTelephoneContactAccueil")

    if (!regex.test(tel)) {
        message.innerHTML = "Veuillez entrer un numéro de téléphone valide. <br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}

//Regex sujet

function regexSujetFormulaireContactAccueil(e){
    var regex = /^(?=.{4,40}$)[a-zA-Z0-9À-ÿ\s\-']+$/;
    var sujet = document.getElementById("sujetFormulaireContactAccueil").value;
    var message = document.getElementById("messageErreurSujetContactAccueil")

    if (sujet.length < 4) {
        message.innerHTML = "Votre sujet doit contenir au moins 4 caractères.<br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else if (sujet.length > 40) {
        message.innerHTML = "Votre sujet est trop grand, il doit contenir moins de 40 caractères.<br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else if (!regex.test(sujet)) {
        message.innerHTML = "Veuillez entrer un sujet valide. <br> Il ne doit pas contenir de caractère spéciaux <br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}


//Regex Message

function regexMessageFormFormulaireContactAccueil(e){
    var regex = /^(?=.{4,500}$)[a-zA-Z0-9À-ÿ\s\-']+$/;
    var messageForm = document.getElementById("messageFormulaireContactAccueil").value;
    var message = document.getElementById("messageErreurMessageContactAccueil")

    if (messageForm.length < 4) {
        message.innerHTML = "Votre message doit contenir au moins 4 caractères.";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else if (!regex.test(messageForm)) {
        message.innerHTML = "Veuillez entrer un message valide. <br> Il ne doit pas contenir de caractère spéciaux";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}