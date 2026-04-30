<?php
require_once 'connexion.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: index.php?msg=suppr");
exit;
?>