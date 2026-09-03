<?php $user = wp_get_current_user(); ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Custom Portal | Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header"><a class="brand" href="./">Custom<span>Portal</span></a><nav><a href="./">Home</a><a href="?page=admin">Admin</a><a class="nav-action" href="?page=logout">Logout</a></nav></header>
<main class="content-shell">
    <p class="eyebrow">Authenticated area</p>
    <h1>Good to see you, <?= htmlspecialchars($user['display_name'], ENT_QUOTES, 'UTF-8') ?>.</h1>
    <p class="lede">Berikut data user dari session mock WordPress.</p>
    <section class="profile-grid">
        <div class="profile-intro"><span class="avatar">A</span><h2><?= htmlspecialchars($user['display_name'], ENT_QUOTES, 'UTF-8') ?></h2><p>Active session</p></div>
        <dl class="details">
            <div><dt>Username</dt><dd><?= htmlspecialchars($user['user_login'], ENT_QUOTES, 'UTF-8') ?></dd></div>
            <div><dt>Email</dt><dd><?= htmlspecialchars($user['user_email'], ENT_QUOTES, 'UTF-8') ?></dd></div>
            <div><dt>Role</dt><dd><?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?></dd></div>
        </dl>
    </section>
</main>
<footer><span>Custom Portal</span><span>Authenticated session</span></footer>
</body>
</html>