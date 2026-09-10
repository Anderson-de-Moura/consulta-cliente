<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários - DataConsult B2B</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
</head>
<body class="page-shell">
    <main class="content-wide">
        <div class="page-heading">
            <div>
                <span class="eyebrow">Administração</span>
                <h1>Gestão de usuários</h1>
            </div>
            <a class="button button-primary" href="<?= BASE_URL ?>/admin/criar_usuario.php">Novo usuário</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Saldo</th><th>Status</th></tr></thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= (int) $user['id_usuario'] ?></td>
                            <td><?= htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= (int) $user['saldo_creditos'] ?> créditos</td>
                            <td><?= htmlspecialchars($user['status_conta'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>