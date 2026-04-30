<?php
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom     = trim($_POST['nom']);
    $prenom  = trim($_POST['prenom']);
    $filiere = $_POST['filiere_id'];

    if (empty($nom) || empty($prenom) || empty($filiere)) {
        header("Location: index.php");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (:nom, :prenom, :filiere_id)");
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':filiere_id' => (int) $filiere
    ]);

    header("Location: index.php?msg=ajout");
    exit;

} else {
    header("Location: index.php");
    exit;
}
?>