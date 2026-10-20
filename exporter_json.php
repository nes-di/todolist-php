<?php
require __DIR__ . '/connexion.php';

// Récupère toutes les tâches depuis la base de données.
$requete = $pdo->query(
    'SELECT id_tache AS id,
            nom_tache AS titre,
            difficulte_tache AS difficulte,
            termine_tache AS terminee
     FROM tache'
);
$taches = $requete->fetchAll();

// Convertit le tableau PHP en JSON lisible, en gardant les accents.
$json = json_encode($taches, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
if ($json === false) {
    exit('Impossible de convertir les tâches en JSON.');
}

// Deux niveaux au-dessus du projet, le dossier se trouve hors de htdocs.
$dossierTravail = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'todolist-data';
if (!is_dir($dossierTravail) && !mkdir($dossierTravail, 0775, true)) {
    exit('Impossible de créer le dossier de travail.');
}

$fichierJson = $dossierTravail . DIRECTORY_SEPARATOR . 'taches.json';
if (file_put_contents($fichierJson, $json) === false) {
    exit('Impossible d’écrire le fichier taches.json.');
}

echo 'Export terminé : ' . htmlspecialchars($fichierJson, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
