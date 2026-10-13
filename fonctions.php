<?php

// Une fonction retourne une valeur : elle ne l'affiche pas automatiquement.
function compterTachesRestantes(array $taches): int
{
    $nombre = 0;
    foreach ($taches as $tache) {
        if (empty($tache['terminee'])) {
            $nombre++;
        }
    }
    return $nombre;
}

function libelleDifficulte(string $difficulte): string
{
    if ($difficulte === 'facile') {
        return 'Facile';
    } elseif ($difficulte === 'moyen') {
        return 'Moyen';
    }
    return 'Difficile';
}

// Échapper le texte au moment de l'insérer dans du HTML.
function echapper(string $texte): string
{
    return htmlspecialchars($texte, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
