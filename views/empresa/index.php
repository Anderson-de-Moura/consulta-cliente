<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - DataConsult B2B</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
</head>
<body class="page-shell dashboard-shell">
    <header class="app-header">
        <strong class="brand">DataConsult B2B</strong>
        <div class="app-actions"><span><?= htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') ?></span><a href="<?= BASE_URL ?>/logout.php">Sair</a></div>
    </header>
    <main class="dashboard-content">
        <div class="dashboard-heading">
            <div><span class="eyebrow">Gestão da empresa</span><h1><?= htmlspecialchars($company['nome_empresa'] ?? 'Empresa', ENT_QUOTES, 'UTF-8') ?></h1><p class="muted">Administre os operadores autorizados a consultar CPFs.</p></div>
            <div class="credit-card"><span>Status do contrato</span><strong><?= htmlspecialchars(ucfirst($company['status_contrato'] ?? 'ativo'), ENT_QUOTES, 'UTF-8') ?></strong><a href="<?= BASE_URL ?>/empresa/criar_usuario.php">Adicionar operador</a></div>
        </div>
        <section class="dashboard-panel">
            <div class="panel-heading"><div><span class="eyebrow">Equipe</span><h2>Operadores da empresa</h2></div><a class="button button-primary" href="<?= BASE_URL ?>/empresa/criar_usuario.php">Novo operador</a></div>
            <div class="table-wrapper"><table><thead><tr><th>Nome</th><th>E-mail</th><th>Perfil</th><th>Status</th></tr></thead><tbody>
                <?php foreach ($users as $user): ?><tr><td><?= htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars(ucfirst($user['nivel_acesso']), ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars(ucfirst($user['status_conta']), ENT_QUOTES, 'UTF-8') ?></td></tr><?php endforeach; ?>
            </tbody></table></div>
        </section>
    </main>
</body>
</html>