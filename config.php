<?php
// À adapter à votre installation locale. Ne pas utiliser root en production.
return [
   'host' => '127.0.0.1',
   'port' => '3306',
   'base' => 'demophp',
   'utilisateur' => 'root',
   'mot_de_passe' => '',
];

$requete = $pdo->query("SELECT * FROM taches");
$taches = $requete->fetchAll();