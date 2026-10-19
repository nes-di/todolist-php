<?php
require __DIR__ . '/connexion.php';

// Commence par une requête qui récupère toutes les tâches.
$sql = 'SELECT id_tache AS id,
               nom_tache AS titre,
               difficulte_tache AS difficulte,
               termine_tache AS terminee
        FROM tache';
$parametres = [];

// Ajoute le filtre SQL et la valeur correspondante selon l'état demandé.
if ($etat === 'a-faire') {
    $sql .= ' WHERE termine_tache = :terminee';
    $parametres['terminee'] = 0;
} elseif ($etat === 'terminees') {
    $sql .= ' WHERE termine_tache = :terminee';
    $parametres['terminee'] = 1;
}

// Prépare la requête, transmet le paramètre séparément, puis récupère les résultats.
$requete = $pdo->prepare($sql);
$requete->execute($parametres);
$taches = $requete->fetchAll();
 