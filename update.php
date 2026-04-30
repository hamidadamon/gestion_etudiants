<?php
require_once 'connexion.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = :id");
$stmt->execute([':id' => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    header("Location: index.php");
    exit;
}

$filieres = $pdo->query("SELECT * FROM filieres ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = trim($_POST['nom']);
    $prenom  = trim($_POST['prenom']);
    $filiere = $_POST['filiere_id'];

    if (!empty($nom) && !empty($prenom) && !empty($filiere)) {
        $stmt = $pdo->prepare("UPDATE etudiants SET nom=:nom, prenom=:prenom, filiere_id=:filiere_id WHERE id=:id");
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':filiere_id' => (int) $filiere,
            ':id' => $id
        ]);
        header("Location: index.php?msg=modif");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un etudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <h1>Modifier un etudiant</h1>

    <form id="form-update" action="update.php?id=<?= $id ?>" method="POST">
        <label>Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>">
        <span class="error-msg" id="err-nom"></span>

        <label>Prenom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>">
        <span class="error-msg" id="err-prenom"></span>

        <label>Filiere :</label>
        <select id="filiere_id" name="filiere_id">
            <option value="">-- Choisir --</option>
            <?php foreach ($filieres as $f): ?>
                <option value="<?= $f['id'] ?>" <?= ($f['id'] == $etudiant['filiere_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($f['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="error-msg" id="err-filiere"></span>

        <button type="submit">Enregistrer</button>
        <a href="index.php">Annuler</a>
    </form>

</div>
<script src="assets/js/script.js"></script>
</body>
</html>