<?php

// Initialisation d'un tableau associatif pour stocker les données du formulaire et les messages d'erreurs
$array = array(
    "firstname" => "", "name" => "", "phone" => "", "email" => "", "message" => "",
    "firstnameError" => "", "nameError" => "", "phoneError" => "", "emailError" => "", "messageError" => "",
    "isSuccess" => false // Indicateur de succès pour vérifier si le formulaire est valide
);

// Adresse email de destination pour recevoir les messages du formulaire
$emailTo = "abdel-nacer.zelloufi@outlook.fr";

// Vérification si la requête envoyée est de type POST (soumission du formulaire)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et validation des données du formulaire
    $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["name"] = verifyInput($_POST["name"]);
    $array["phone"] = verifyInput($_POST["phone"]);
    $array["email"] = verifyInput($_POST["email"]);
    $array["message"] = verifyInput($_POST["message"]);
    
    // Par défaut, on suppose que tout est correct
    $array["isSuccess"] = true; 
    $emailText = ""; // Variable pour stocker le contenu du message à envoyer par email

    // Vérification du prénom
    if (empty($array["firstname"])) {
        $array["firstnameError"] = "Je veux ton prénom !"; // Message d'erreur si le prénom est vide
        $array["isSuccess"] = false; // Indicate que le formulaire contient une erreur
    } else {
        $emailText .= "Firstname: {$array['firstname']}\n"; // Ajoute le prénom au corps du message
    }

    // Vérification du nom
    if (empty($array["name"])) {
        $array["nameError"] = "Je veux ton nom également !";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "Name: {$array['name']}\n";
    }

    // Vérification de l'email
    if (empty($array["email"])) {
        $array["emailError"] = "Ton mail, pour te contacter ;) ";
        $array["isSuccess"] = false;
    } elseif (!isEmail($array["email"])) { // Vérifie si l'email est valide
        $array["emailError"] = "Ton mail n'en est pas vraiment un ;) ";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "E-mail: {$array['email']}\n";
    }

    // Vérification du numéro de téléphone
    if (empty($array["phone"])) {
        $array["phoneError"] = "Ton numéro, au cas où.";
        $array["isSuccess"] = false;
    } elseif (!isPhone($array["phone"])) { // Vérifie si le numéro de téléphone est valide
        $array["phoneError"] = "Ton numéro n'est pas valide.";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "Téléphone: {$array['phone']}\n";
    }

    // Vérification du message
    if (empty($array["message"])) {
        $array["messageError"] = "Un petit message ?";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "Message: {$array['message']}\n";
    }

    // Si toutes les vérifications sont correctes
    if ($array["isSuccess"]) {
        // Préparation des en-têtes et envoi de l'email
        $headers = "From: {$array['firstname']} {$array['name']} <{$array['email']}>\r\nReply-To: {$array['email']}";
        mail($emailTo, "Un message de votre site", $emailText, $headers);
        
        // Réinitialisation des champs du formulaire après l'envoi
        $array["firstname"] = $array["name"] = $array["email"] = $array["phone"] = $array["message"] = "";
    }
    
    // Envoi des données au format JSON pour l'usage avec AJAX
    echo json_encode($array);
}

// Fonction de nettoyage des données d'entrée (évite injections et erreurs de saisie)
function verifyInput($var) {
    $var = trim($var); // Supprime les espaces en début et fin
    $var = stripslashes($var); // Supprime les antislashs
    $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
    return $var;
}

// Fonction pour vérifier si l'email est valide
function isEmail($var) {
    return filter_var($var, FILTER_VALIDATE_EMAIL); // Utilise un filtre PHP pour valider l'email
}

// Fonction pour vérifier si le numéro de téléphone est valide (ne contient que des chiffres)
function isPhone($var) {
    return preg_match("/^[0-9]+$/", $var); // Expression régulière pour autoriser uniquement les chiffres
}

?>
