<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/includes/mock-wp-functions.php';
require_once __DIR__ . '/includes/class-pages.php';
require_once __DIR__ . '/includes/class-auth.php';
require_once __DIR__ . '/includes/class-admin.php';

$auth = new Custom_Portal_Auth();
$page = $_GET['page'] ?? 'home';

if ($page === 'logout') {
    $auth->logout();
    header('Location: ?page=login');
    exit;
}

$error = null;
if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($auth->login($_POST['username'] ?? '', $_POST['password'] ?? '')) {
        header('Location: ?page=dashboard');
        exit;
    }
    $error = 'Username atau password salah. Silakan coba lagi.';
}

$pages = new Custom_Portal_Pages();
$pages->render($page, ['error' => $error]);