<?php
// __DIR__ désigne le dossier de ce fichier, quel que soit le dossier de lancement.
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

<section class="statistiques" aria-label="Résumé des tâches">
    <div><strong><?= $total ?></strong><span>Au total</span></div>
    <div><strong><?= $restantes ?></strong><span>À faire</span></div>
    <div><strong><?= $terminees ?></strong><span>Terminées</span></div>
</section>

<section class="liste" aria-labelledby="titre-liste">
    <h2 id="titre-liste">Mes tâches</h2>
    <?php if (empty($taches)): ?>
        <p class="message">Aucune tâche pour le moment.</p>
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
        <?php if ($restantes === 0): ?>
            <p class="message">Bravo, toutes les tâches sont terminées !</p>
        <?php endif; ?>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/includes/pied.php'; ?>
