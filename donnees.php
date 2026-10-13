<?php
require __DIR__ . '/connexion.php';

$requete = $pdo->query(
    'SELECT id_tache AS id,
            nom_tache AS titre,
            difficulte_tache AS difficulte,
            termine_tache AS terminee
     FROM tache'
);
$taches = $requete->fetchAll();
