<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Custom Portal | Admin</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header"><a class="brand" href="./">Custom<span>Portal</span></a><nav><a href="./">Home</a><a href="?page=dashboard">Dashboard</a><a class="nav-action" href="?page=logout">Logout</a></nav></header>
<main class="content-shell">
    <p class="eyebrow">Plugin overview</p>
    <h1>Admin status.</h1>
    <p class="lede">Informasi statis ini mensimulasikan custom admin page WordPress.</p>
    <section class="status-table">
        <?php foreach ($admin_info as $label => $value): ?>
            <div><dt><?= htmlspecialchars(ucwords(str_replace('_', ' ', $label)), ENT_QUOTES, 'UTF-8') ?></dt><dd><?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?></dd></div>
        <?php endforeach; ?>
    </section>
</main>
<footer><span>Custom Portal</span><span>Admin simulation</span></footer>
</body>
</html>