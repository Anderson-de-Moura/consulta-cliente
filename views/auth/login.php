<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DataConsult B2B</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
</head>
<body class="page-shell">
    <main class="auth-card">
        <a class="brand brand-dark" href="<?= BASE_URL ?>/">DataConsult B2B</a>
        <h1>Acesso ao sistema</h1>
        <?php if ($error): ?>
            <p class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <form class="form-stack" method="post" action="<?= BASE_URL ?>/login.php">
            <label>E-mail <input type="email" name="email" autocomplete="email" required></label>
            <label>Senha <input type="password" name="senha" autocomplete="current-password" required></label>
            <button class="button button-primary" type="submit">Entrar</button>
        </form>
    </main>
</body>
</html>