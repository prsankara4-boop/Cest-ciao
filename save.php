<?php
// Autoriser l'accès
header("Content-Type: application/json");

// Créer le dossier s'il n'existe pas
$folder = "base_donnees_linko";
if (!is_dir($folder)) { mkdir($folder, 0777, true); }

// Récupérer les données du site
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    // Fichier principal qui contient TOUTES les annonces
    $mainFile = $folder . "/toutes_les_annonces.txt";
    
    $line = "DATE: " . date("d-m-Y H:i") . " | NOM: " . $data['nom'] . " | MATIERE: " . $data['mat'] . " | WA: " . $data['wa'] . " | LIEU: " . $data['prov'] . " (" . $data['reg'] . ")\n";
    
    // Enregistrer dans le fichier (ajoute à la suite)
    file_put_contents($mainFile, $line, FILE_APPEND);

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>