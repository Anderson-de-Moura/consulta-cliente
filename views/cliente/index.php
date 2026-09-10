<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DataConsult B2B</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
</head>
<body class="page-shell dashboard-shell">
    <header class="app-header">
        <strong class="brand">DataConsult B2B</strong>
        <div class="app-actions">
            <span><?= htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php if (($_SESSION['nivel_acesso'] ?? null) === 'admin'): ?>
                <a href="<?= BASE_URL ?>/admin/listar_usuarios.php">Administração</a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>/logout.php">Sair</a>
        </div>
    </header>
    <main class="dashboard-content">
        <div class="dashboard-heading">
            <div>
                <span class="eyebrow">Área do cliente</span>
                <h1>Consultas cadastrais</h1>
                <p class="muted">Consulte dados com justificativa legal e rastreabilidade.</p>
            </div>
            <div class="credit-card">
                <span>Créditos disponíveis</span>
                <strong><?= number_format($balance, 0, ',', '.') ?></strong>
                <a href="mailto:comercial@seudominio.com.br?subject=Recarga%20de%20créditos">Solicitar recarga</a>
            </div>
        </div>

        <div class="dashboard-grid">
            <section class="dashboard-panel consultation-panel">
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow">Nova consulta</span>
                        <h2>Encontre informações com responsabilidade</h2>
                    </div>
                    <span class="status-pill">LGPD ativa</span>
                </div>
                <?php if ($consultationMessage): ?>
                    <p class="form-message <?= $consultedCpf ? 'form-success' : 'form-error' ?>">
                        <?= htmlspecialchars($consultationMessage, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>
                <form class="form-stack consultation-form" method="post" id="consultation-form">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                    <label>CPF a consultar
                        <input class="cpf-input" type="text" name="cpf" inputmode="numeric" maxlength="14" placeholder="000.000.000-00" required>
                    </label>
                    <label>Justificativa legal obrigatória
                        <select name="justificativa_lgpd" required>
                            <option value="">Selecione o motivo da consulta...</option>
                            <option value="protecao_credito">Proteção ao crédito</option>
                            <option value="prevencao_fraude">Prevenção a fraude</option>
                            <option value="cobranca">Ação de cobrança</option>
                        </select>
                    </label>
                    <label class="consent-check">
                        <input type="checkbox" id="legal-consent" required>
                        <span>Confirmo que possuo base legal para consultar este titular.</span>
                    </label>
                    <button class="button button-primary consultation-submit" type="submit" disabled>Consultar CPF</button>
                </form>
            </section>

            <section class="dashboard-panel result-panel">
                <div class="panel-heading">
                    <div>
                        <span class="eyebrow">Resultado</span>
                        <h2>Dados encontrados</h2>
                    </div>
                </div>
                <?php if ($consultedCpf): ?>
                    <p class="result-placeholder">A consulta de <?= htmlspecialchars(substr($consultedCpf, 0, 3) . '.***.***-**', ENT_QUOTES, 'UTF-8') ?> foi validada, mas a fonte de dados ainda não está conectada.</p>
                <?php else: ?>
                    <div class="empty-state">
                        <strong>Nenhum resultado por enquanto</strong>
                        <span>Preencha o CPF e a justificativa legal para iniciar uma consulta.</span>
                    </div>
                <?php endif; ?>
                <div class="result-blocks" aria-label="Categorias de resultado">
                    <div><span>Telefones</span><strong>--</strong></div>
                    <div><span>E-mails</span><strong>--</strong></div>
                    <div><span>WhatsApp</span><strong>--</strong></div>
                </div>
            </section>
        </div>

        <section class="dashboard-panel history-panel">
            <div class="panel-heading">
                <div>
                    <span class="eyebrow">Transparência</span>
                    <h2>Atividade recente</h2>
                </div>
                <span class="muted">Últimas consultas</span>
            </div>
            <div class="table-wrapper">
                <table class="history-table">
                    <thead><tr><th>CPF</th><th>Base legal</th><th>Status</th><th>Data</th></tr></thead>
                    <tbody>
                        <?php if (!$history): ?>
                            <tr><td colspan="4" class="empty-row">Nenhuma consulta registrada.</td></tr>
                        <?php else: ?>
                            <?php foreach ($history as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['cpf_mascarado'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars(ucwords(str_replace('_', ' ', $item['justificativa_lgpd'])), ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><span class="operation operation-positive"><?= htmlspecialchars(ucwords(str_replace('_', ' ', $item['status_consulta'])), ENT_QUOTES, 'UTF-8') ?></span></td>
                                    <td><?= date('d/m/Y H:i', strtotime($item['data_consulta'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script src="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/js/dashboard.js"></script>
</body>
</html>