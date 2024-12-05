<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = getConnection();
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    header('Location: index.html');
}
?>
