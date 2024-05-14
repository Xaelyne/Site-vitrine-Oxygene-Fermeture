<?php
// // Inclure la bibliothèque PHPMailer
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // Chemin vers le fichier autoload.php de PHPMailer

// // Vérifier si le formulaire a été soumis
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Récupérer les données du formulaire
//     $nom = $_POST['nomFormulaireContact'];
//     $telephone = $_POST['telephoneFormulaireContact'];
//     $email = $_POST['emailFormulaireContact'];
//     $sujet = $_POST['sujetFormulaireContact'];
//     $message = $_POST['messageFormulaireContact'];

//     // Instancier PHPMailer
//     $mail = new PHPMailer(true); // true active les exceptions

//     try {
//         // Paramètres du serveur SMTP
//         $mail->isSMTP();
//         $mail->Host = 'smtp.orange.fr'; // Adresse du serveur SMTP
//         $mail->SMTPAuth = true;
//         $mail->Username = 'mulett90hh@gmail.com'; // Votre adresse e-mail SMTP
//         $mail->Password = 'votre_mot_de_passe'; // Votre mot de passe SMTP
//         $mail->SMTPSecure = 'tls'; // TLS ou SSL selon le serveur
//         $mail->Port = 587; // Port SMTP

//         // Destinataire
//         $mail->setFrom('mulett90hh@gmail.com', 'Votre Nom'); // Votre adresse e-mail et votre nom
//         $mail->addAddress('destinataire@example.com', 'Destinataire'); // Adresse e-mail du destinataire

//         // Contenu du message
//         $mail->isHTML(true); // Paramétrer le format du message en HTML
//         $mail->Subject = $sujet;
//         $mail->Body    = "Nom: $nom <br> Téléphone: $telephone <br> Email: $email <br> Message: $message";

//         // Envoyer l'e-mail
//         $mail->send();
//         echo 'Message envoyé avec succès!';
//     } catch (Exception $e) {
//         echo "Erreur lors de l'envoi du message: {$mail->ErrorInfo}";
//     }
// }
?>