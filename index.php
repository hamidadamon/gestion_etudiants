<?php
require_once 'connexion.php';

$stmt_filieres = $pdo->query("SELECT * FROM filieres ORDER BY nom");
$filieres = $stmt_filieres->fetchAll(PDO::FETCH_ASSOC);

$stmt_etudiants = $pdo->query("SELECT e.id, e.nom, e.prenom, f.nom AS filiere FROM etudiants e JOIN filieres f ON e.filiere_id = f.id ORDER BY e.nom");
$etudiants = $stmt_etudiants->fetchAll(PDO::FETCH_ASSOC);

$message = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Etudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <?php if ($message === 'ajout'): ?>
        <p class="success">Etudiant ajoute avec succes !</p>
    <?php elseif ($message === 'modif'): ?>
        <p class="success">Etudiant modifie avec succes !</p>
    <?php elseif ($message === 'suppr'): ?>
        <p class="success">Etudiant supprime avec succes !</p>
    <?php endif; ?>

    <h1>Gestion des Etudiants</h1>

    <h2>Ajouter un etudiant</h2>
    <form id="form-ajout" action="traitement.php" method="POST">
        <label>Nom :</label>
        <input type="text" id="nom" name="nom">
        <span class="error-msg" id="err-nom"></span>

        <label>Prenom :</label>
        <input type="text" id="prenom" name="prenom">
        <span class="error-msg" id="err-prenom"></span>

        <label>Filiere :</label>
        <select id="filiere_id" name="filiere_id">
            <option value="">-- Choisir --</option>
            <?php foreach ($filieres as $f): ?>
                <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nom']) ?></option>
            <?php endforeach; ?>
        </select>
        <span class="error-msg" id="err-filiere"></span>

        <button type="submit">Ajouter</button>
    </form>

    <h2>Liste des etudiants</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Filiere</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $i => $e): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($e['nom']) ?></td>
                <td><?= htmlspecialchars($e['prenom']) ?></td>
                <td><?= htmlspecialchars($e['filiere']) ?></td>
                <td>
                    <a href="update.php?id=<?= $e['id'] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $e['id'] ?>" onclick="return confirmerSuppression(<?= $e['id'] ?>, '<?= $e['nom'] ?>', '<?= $e['prenom'] ?>')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<script src="assets/js/script.js"></script>
</body>
</html>