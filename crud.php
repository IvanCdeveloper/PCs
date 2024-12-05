<?php
session_start();
require 'functions.php';

$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $stmt = $pdo->prepare("INSERT INTO computers (cpu, ram, gpu, storage) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['cpu'], $_POST['ram'], $_POST['gpu'], $_POST['storage']]);
    }
} elseif ($_GET['action'] === 'read') {
    $stmt = $pdo->query("SELECT * FROM computers");
    echo json_encode($stmt->fetchAll());
} elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM computers WHERE id = ?");
    $stmt->execute([$_GET['id']]);
} elseif ($_GET['action'] === 'checkAuth') {
    echo json_encode(['auth' => isset($_SESSION['user_id'])]);
}
?>
