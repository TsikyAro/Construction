<?php 
// formatage date 
// Date d'origine au format MySQL (YYYY-MM-DD HH:MM:SS)
$dateOrigine = '2024-02-21 17:54:00';

// Convertir la chaîne en objet DateTime
$dateObj = new DateTime($dateOrigine);

// Formater la date selon le format désiré
$dateFormatee = $dateObj->format('d F Y H\hi\ms\s'); // 21 février 2024 17h54min00sec

// Afficher la date formatee
echo $dateFormatee;

//--------------------------------//----------------------------------//-------------------------------------

//formatage nombre 
// Nombre à formater et aligner
$nombre = 100000;

// Formater le nombre avec des séparateurs de milliers
$nombreFormate = number_format($nombre, 0, '', ' ');

// Aligner le nombre en ajoutant des espaces à gauche si nécessaire
$nombreAligne = str_pad($nombreFormate, 8, ' ', STR_PAD_LEFT);

// Afficher le nombre formate et aligne
echo $nombreAligne;  // Résultat : "100 000"

//------------------------------//-----------------------------//-------------------------------------------

//verification int par rapport texte 
$contenuInput = $_POST['votre_input']; // Assurez-vous de remplacer 'votre_input' par le nom de votre input

if (is_numeric($contenuInput)) {
    // C'est un nombre
    echo "Le contenu de l'input est un nombre.";
} else {
    // Ce n'est pas un nombre, donc c'est probablement une chaîne de caractères
    echo "Le contenu de l'input est une chaîne de caractères.";
}

//-------------------------- si double ----------------------------------------------------------------------
$contenuInput = $_POST['votre_input'];

if (is_numeric($contenuInput)) {
    $nombreEntier = intval($contenuInput);
    if (is_int($nombreEntier)) {
        echo "Le contenu de l'input est un nombre entier.";
    } else {
        echo "Le contenu de l'input est un nombre décimal.";
    }
} else {
    echo "Le contenu de l'input est une chaîne de caractères.";
}

