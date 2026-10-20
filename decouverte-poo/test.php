<?php

require __DIR__ . '/Tache.php';

$tache1 = new Tache('Préparer la présentation');
$tache2 = new Tache('Tester le formulaire');
$tache1->terminer();

$taches = [$tache1, $tache2];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Liste des tâches</title>
</head>
<body>
	<h1>Liste des tâches</h1>
	<ul>
		<?php foreach ($taches as $tache): ?>
			<li>
				<?= htmlspecialchars($tache->titre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
				- <?= $tache->terminee ? 'Terminée' : 'À faire' ?>
			</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
