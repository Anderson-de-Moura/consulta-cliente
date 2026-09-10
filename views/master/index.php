<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master - DataConsult B2B</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
</head>
<body class="page-shell dashboard-shell">
    <header class="app-header">
        <strong class="brand">DataConsult B2B</strong>
        <div class="app-actions"><span>Master: <?= htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') ?></span><a href="<?= BASE_URL ?>/logout.php">Sair</a></div>
    </header>
    <main class="dashboard-content">
        <div class="dashboard-heading">
            <div><span class="eyebrow">Visão global</span><h1>Empresas contratantes</h1><p class="muted">Controle contratos, equipes e acesso à plataforma.</p></div>
            <div class="credit-card"><span>Empresas cadastradas</span><strong><?= count($companies) ?></strong><a href="<?= BASE_URL ?>/master/criar_empresa.php">Cadastrar empresa</a></div>
        </div>
        <section class="dashboard-panel" id="empresas">
            <div class="panel-heading"><div><span class="eyebrow">Carteira B2B</span><h2>Todas as empresas</h2></div></div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Empresa</th><th>CNPJ</th><th>Usuários</th><th>Contrato</th></tr></thead>
                    <tbody>
                    <?php foreach ($companies as $company): ?>
                        <tr><td><?= htmlspecialchars($company['nome_empresa'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($company['cnpj'], ENT_QUOTES, 'UTF-8') ?></td><td><?= (int) $company['total_usuarios'] ?></td><td><span class="operation operation-positive"><?= htmlspecialchars(ucfirst($company['status_contrato']), ENT_QUOTES, 'UTF-8') ?></span></td></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>