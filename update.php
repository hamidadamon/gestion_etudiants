<?php
require_once 'connexion.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// Récupérer l'étudiant
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = :id");
$stmt->execute([':id' => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    header("Location: index.php");
    exit;
}

// Récupérer les filières
$filieres = $pdo->query("SELECT * FROM filieres ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = trim($_POST['nom'] ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $filiere = $_POST['filiere_id'] ?? '';

    if (!empty($nom) && !empty($prenom) && !empty($filiere)) {
        $stmt = $pdo->prepare("UPDATE etudiants SET nom = :nom, prenom = :prenom, filiere_id = :filiere_id WHERE id = :id");
        $stmt->execute([
            ':nom'        => $nom,
            ':prenom'     => $prenom,
            ':filiere_id' => (int) $filiere,
            ':id'