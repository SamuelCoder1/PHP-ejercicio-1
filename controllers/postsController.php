<?php
require_once '../includes/session.php';
require_once '../includes/data.php';

if (!isset($_SESSION['user'])) {
    header('Location: loginController.php');
    exit;
}

$user = $_SESSION['user'];
$publishedPosts = array_filter($posts, fn($post) => $post['status'] === 'published');

include '../views/posts.php';
