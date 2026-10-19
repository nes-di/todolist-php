<?php
// Démarre la session avant de générer la page.
session_start();

// Récupère le message, puis l'efface pour qu'il ne réapparaisse pas.
$message = $_SESSION['message'] ?? null;
unset($_SESSION['message']);

// Lit le filtre dans l'URL ; sans paramètre, toutes les tâches sont affichées.
$etat = $_GET['etat'] ?? 'toutes';
// N'accepte que les filtres prévus ; toute autre valeur revient à « toutes ».
if (!in_array($etat, ['toutes', 'a-faire', 'terminees'], true)) {
    $etat = 'toutes';
}

// donnees.php utilise $etat pour choisir les tâches à charger.
require __DIR__ . '/donnees.php';
require __DIR__ . '/fonctions.php';

$titrePage = 'Ma liste de tâches';
$total = count($taches);
$restantes = compterTachesRestantes($taches);
$terminees = $total - $restantes;

include __DIR__ . '/includes/entete.php';
?>

<section class="formulaire-ajout" aria-labelledby="titre-ajout">
    <h2 id="titre-ajout">Ajouter une tâche</h2>
    <form method="post" action="ajouter.php">
        <div>
            <label for="nom_tache">Nom de la tâche</label>
            <input id="nom_tache" name="nom_tache" type="text" required>
        </div>

        <div>
            <label for="difficulte_tache">Difficulté</label>
            <select id="difficulte_tache" name="difficulte_tache">
                <option value="facile">Facile</option>
                <option value="moyen">Moyen</option>
                <option value="difficile">Difficile</option>
            </select>
        </div>

        <button type="submit">Ajouter</button>
    </form>
</section>

<?php if ($message !== null): ?>
    <p class="message"><?= echapper($message) ?></p>
<?php endif; ?>

<section class="statistiques" aria-label="Résumé des tâches">
    <div><strong><?= $total ?></strong><span>Affichées</span></div>
    <div><strong><?= $restantes ?></strong><span>À faire</span></div>
    <div><strong><?= $terminees ?></strong><span>Terminées</span></div>
</section>

<section class="liste" aria-labelledby="titre-liste">
    <h2 id="titre-liste">Mes tâches</h2>
    <nav class="filtres" aria-label="Filtrer les tâches">
        <a href="index.php?etat=toutes" <?= $etat === 'toutes' ? 'aria-current="page"' : '' ?>>Toutes les tâches</a>
        <a href="index.php?etat=a-faire" <?= $etat === 'a-faire' ? 'aria-current="page"' : '' ?>>Les tâches à faire</a>
        <a href="index.php?etat=terminees" <?= $etat === 'terminees' ? 'aria-current="page"' : '' ?>>Les tâches terminées</a>
    </nav>
    <?php if (empty($taches)): ?>
        <p class="message"><?= $etat === 'toutes' ? 'Aucune tâche pour le moment.' : 'Aucune tâche ne correspond à ce filtre.' ?></p>
    <?php else: ?>
        <ul>
            <?php foreach ($taches as $tache): ?>
                <li class="tache <?= $tache['terminee'] ? 'terminee' : '' ?>">
                    <div>
                        <h3><?= echapper($tache['titre']) ?></h3>
                        <p>Difficulté : <?= echapper(libelleDifficulte($tache['difficulte'])) ?></p>
                    </div>
                    <span class="etat"><?= $tache['terminee'] ? 'Terminée' : 'À faire' ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ($etat === 'toutes' && $restantes === 0): ?>
            <p class="message">Bravo, toutes les tâches sont terminées !</p>
        <?php endif; ?>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/includes/pied.php'; ?>
