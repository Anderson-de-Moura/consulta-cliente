<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataConsult B2B</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="brand">DataConsult B2B</div>
        <a class="button button-light" href="<?= BASE_URL ?>/login.php">Acessar sistema</a>
    </header>

    <main>
        <section class="hero">
            <h1>Validação cadastral segura para sua empresa</h1>
            <p>Consulte dados com agilidade, rastreabilidade e responsabilidade para apoiar suas decisões comerciais.</p>
            <a class="button button-primary" href="mailto:comercial@seudominio.com.br">Solicitar conta comercial</a>
        </section>

        <section class="features" aria-label="Benefícios da plataforma">
            <article class="feature">
                <h2>Pay-as-you-go</h2>
                <p>Compre créditos e pague apenas pelas consultas realizadas, sem mensalidades inesperadas.</p>
            </article>
            <article class="feature">
                <h2>Conformidade LGPD</h2>
                <p>Tenha uma operação com justificativa legal e trilha de auditoria para cada consulta.</p>
            </article>
            <article class="feature">
                <h2>Dados atualizados</h2>
                <p>Encontre informações confiáveis para reduzir riscos e tornar sua operação mais eficiente.</p>
            </article>
        </section>
    </main>

    <footer class="site-footer">
        &copy; <?= date('Y') ?> DataConsult B2B. Uso exclusivo corporativo.
    </footer>
</body>
</html>