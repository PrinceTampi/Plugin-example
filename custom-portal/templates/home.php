<?php $logged_in = is_user_logged_in(); ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Custom Portal | Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <a class="brand" href="./">Custom<span>Portal</span></a>
    <nav aria-label="Navigasi utama">
        <a href="./">Home</a>
        <?php if ($logged_in): ?>
            <a href="?page=dashboard">Dashboard</a>
            <a href="?page=admin">Admin</a>
            <a class="nav-action" href="?page=logout">Logout</a>
        <?php else: ?>
            <a class="nav-action" href="?page=login">Login</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">PHP native / plugin sandbox</p>
            <h1>Portal sederhana, struktur yang jelas.</h1>
            <p class="lede">Rasakan alur public page, autentikasi, dashboard, dan admin page dalam satu project kecil yang mudah dipelajari.</p>
            <a class="button" href="<?= $logged_in ? '?page=dashboard' : '?page=login' ?>">
                <?= $logged_in ? 'Open dashboard' : 'Get started' ?> <span aria-hidden="true">-&gt;</span>
            </a>
        </div>
        <div class="hero-panel" aria-label="Ringkasan fitur">
            <span class="panel-kicker">FLOW / 01</span>
            <strong>Public</strong>
            <strong>Authenticated</strong>
            <strong>Admin simulation</strong>
            <span class="panel-line"></span>
            <small>Built for learning the WordPress plugin shape.</small>
        </div>
    </section>
    <section class="about" id="about">
        <p class="eyebrow">Inside the sandbox</p>
        <h2>Setiap bagian punya tempatnya.</h2>
        <div class="feature-grid">
            <article><span>01</span><h3>Mock WordPress</h3><p>Fungsi session meniru login, user aktif, dan logout.</p></article>
            <article><span>02</span><h3>Protected UI</h3><p>Dashboard hanya bisa dibuka setelah autentikasi berhasil.</p></article>
            <article><span>03</span><h3>Migration ready</h3><p>Folder dan penamaan dibuat dekat dengan plugin WordPress asli.</p></article>
        </div>
    </section>
</main>
<footer><span>Custom Portal</span><span>Learning build / 1.0.0</span></footer>
<script src="assets/js/app.js"></script>
</body>
</html>