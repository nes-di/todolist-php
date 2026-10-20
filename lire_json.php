<?php
// Le même chemin est utilisé par exporter_json.php, hors de htdocs.
$fichierJson = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR
    . 'todolist-data' . DIRECTORY_SEPARATOR . 'taches.json';

// Vérifie que l'export a déjà été créé.
if (!file_exists($fichierJson)) {
    exit('Le fichier taches.json est introuvable. Lancez exporter_json.php d’abord.');
}

// Lit le texte contenu dans le fichier.
$contenu = file_get_contents($fichierJson);
if ($contenu === false) {
    exit('Impossible de lire le fichier taches.json.');
}

// Transforme le JSON en tableau associatif PHP et vérifie qu'il est valide.
$taches = json_decode($contenu, true);
if (json_last_error() !== JSON_ERROR_NONE || !is_array($taches)) {
    exit('Le fichier taches.json contient un JSON invalide.');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tâches exportées</title>
</head>
<body>
    <h1>Tâches exportées</h1>
    <?php if (empty($taches)): ?>
        <p>Aucune tâche dans le fichier.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($taches as $tache): ?>
                <li><?= htmlspecialchars($tache['titre'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
