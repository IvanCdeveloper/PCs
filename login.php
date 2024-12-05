<?php
session_start();
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = getConnection();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.html');
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>
