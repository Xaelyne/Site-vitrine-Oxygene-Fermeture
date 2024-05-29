<?php
// Inclure la bibliothèque PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nomFormulaireContactAccueil'];
    $telephone = $_POST['telephoneFormulaireContactAccueil'];
    $email = $_POST['emailFormulaireContactAccueil'];
    $sujet = $_POST['sujetFormulaireContactAccueil'];
    $message = $_POST['messageFormulaireContactAccueil'];

    // Charger les variables d'environnement depuis le fichier env.ini pour sécuriser les données
    $iniFilePath = dirname(__DIR__) . '/env.ini';  // Mise à jour du chemin pour pointer vers le répertoire parent
    if (file_exists($iniFilePath)) {
        $config = parse_ini_file($iniFilePath);
        if ($config === false) {
            die('Erreur lors du chargement du fichier env.ini');
        }
    } else {
        die('Le fichier env.ini est introuvable.');
    }

    // Vérifier si toutes les clés nécessaires sont présentes
    $requiredKeys = ['SMTP_HOST', 'SMTP_USERNAME', 'SMTP_PASSWORD', 'SMTP_PORT'];
    foreach ($requiredKeys as $key) {
        if (!isset($config[$key])) {
            die("Clé manquante dans le fichier env.ini: $key");
        }
    }

    // Instancier PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP
        $mail->isSMTP();
        $mail->Host = $config['SMTP_HOST']; // Adresse du serveur SMTP // smtp.orange.fr
        $mail->SMTPAuth = true;
        $mail->Username = $config['SMTP_USERNAME']; // adresse e-mail SMTP
        $mail->Password = $config['SMTP_PASSWORD']; //  mot de passe SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $config['SMTP_PORT']; // Port SMTP // Port orange 465

        // Destinataire
        $mail->setFrom($email,$nom); // Votre adresse e-mail et nom recupéré dans le formulaire
        $mail->addAddress($config['SMTP_USERNAME']); // Adresse e-mail du destinataire
        $mail->addReplyTo($email, $nom);
        // Contenu du message
        $mail->isHTML(true); // Paramétrer le format du message en HTML
        $mail->Subject = $sujet;
        $mail->Body = "<h2>Cet email provient du formulaire de contact</h2<br><br> <h3>Informations du client :</h3><br> Nom: $nom <br> Téléphone: $telephone <br> Email: $email <br><br> Sujet: $sujet <br> Message: $message";

        // Envoyer l'e-mail
        $mail->send();
    } catch (Exception $e) {
    }
}
?>