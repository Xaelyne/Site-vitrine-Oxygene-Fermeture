<?php
// Inclure la bibliothèque PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nomFormulaireContact'];
    $telephone = $_POST['telephoneFormulaireContact'];
    $email = $_POST['emailFormulaireContact'];
    $sujet = $_POST['sujetFormulaireContact'];
    $message = $_POST['messageFormulaireContact'];

    // Instancier PHPMailer
    $mail = new PHPMailer(true); // true active les exceptions

    try {
        // Paramètres du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Adresse du serveur SMTP // smtp.orange.fr
        $mail->SMTPAuth = true;
        $mail->Username = 'mulett90hh@gmail.com'; // Votre adresse e-mail SMTP
        $mail->Password = 'ldpxycgnnlsnlhfn'; // Votre mot de passe SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Port SMTP // Port orange 465

        // Destinataire
        $mail->setFrom($email,$nom); // Votre adresse e-mail et votre nom
        $mail->addAddress('mulett90hh@gmail.com'); // Adresse e-mail du destinataire
        $mail->addReplyTo($email, $nom);
        // Contenu du message
        $mail->isHTML(true); // Paramétrer le format du message en HTML
        $mail->Subject = $sujet;
        $mail->Body    = "Nom: $nom <br> Téléphone: $telephone <br> Email: $email <br> Message: $message";

        // Envoyer l'e-mail
        $mail->send();
        echo 'Message envoyé avec succès!';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message: {$mail->ErrorInfo}";
    }
}
?>