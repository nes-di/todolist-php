<?php
// Démarre ou reprend la session avant tout affichage.
session_start();
require __DIR__ . '/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom_tache'] ?? '';
    $difficulte = $_POST['difficulte_tache'] ?? '';

    if (!is_string($nom) || !is_string($difficulte)) {
        exit('Données invalides.');
    }

    $nom = trim($nom);

    if ($nom === '') {
        exit('Le titre est obligatoire.');
    }

    if (!in_array($difficulte, ['facile', 'moyen', 'difficile'], true)) {
        exit('La difficulté est invalide.');
    }

    $sql = 'INSERT INTO tache (nom_tache, difficulte_tache, termine_tache)
            VALUES (?, ?, 0)';
    $requete = $pdo->prepare($sql);
    $requete->execute([$nom, $difficulte]);

    // Garde le message en session pour qu'il survive à la redirection.
    $_SESSION['message'] = 'La tâche a bien été ajoutée';
}

// Envoie l'utilisateur vers la liste après le traitement du formulaire.
header('Location: index.php');
exit;