var btn = document.getElementById('boutonSubmitForm');

btn.addEventListener("click",regexEmail);
btn.addEventListener("click",regexNom);
btn.addEventListener("click",regexTelephone);
btn.addEventListener("click",regexSujet);
btn.addEventListener("click",regexMessageForm);


//Regex Email

function regexEmail(e){
    var regex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+.([a-zA-Z]{2,3})$/;
    var email = document.getElementById("emailFormulaireContact").value;
    var message = document.getElementById("messageErreurEmail")

    if (!regex.test(email)) {
        message.innerHTML = "Veuillez entrer une adresse email valide. <br> Par exemple : Abc123@exemple.com <br> <br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}

//Regex Nom

function regexNom(e){
    var regex = /^[A-Za-zÀ-ÿà-ÿ]{2,}(?:[-\s][A-Za-zÀ-ÿà-ÿ]{2,})*$/;
    var nom = document.getElementById("nomFormulaireContact").value;
    var message = document.getElementById("messageErreurNom")

    if (!regex.test(nom)) {
        message.innerHTML = "Veuillez entrer un nom valide.<br>2 caractères minimum.<br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}

//Regex Téléphone

function regexTelephone(e){
    var regex = /^(?:0|\+33)[1-9](?:[\s.-]*\d{2}){4}$/;
    var tel= document.getElementById("telephoneFormulaireContact").value;
    var message = document.getElementById("messageErreurTelephone")

    if (!regex.test(tel)) {
        message.innerHTML = "Veuillez entrer un numéro de téléphone valide. <br><br>";
        e.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        message.innerHTML = ""; // Réinitialise le message d'erreur
    }

}

//Regex sujet

function regexSujet(e){
    var regex = /^(?=.{4,40}$)[a-zA-Z0-9À-ÿ\s\-']+$/;
    var sujet = document.getElementById("sujetFormulaireContact").value;
    var message = document.getElementById("messageErreurSujet")

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

function regexMessageForm(e){
    var regex = /^(?=.{4,500}$)[a-zA-Z0-9À-ÿ\s\-']+$/;
    var messageForm = document.getElementById("messageFormulaireContact").value;
    var message = document.getElementById("messageErreurMessage")

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


