<?php
require_once '../includes/session.php';
require_once '../includes/data.php';

if (isset($_SESSION['user'])) {
    header('Location: postsController.php');
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: postsController.php');
            exit;
        }
    }
    $error = "Correo o contraseña incorrectos.";
}

include '../views/login.php';
