<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo usuário - DataConsult B2B</title>
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
</head>
<body class="page-shell">
    <main class="content-card">
        <a class="back-link" href="<?= BASE_URL ?>/admin/listar_usuarios.php">Voltar para usuários</a>
        <h1>Novo usuário</h1>
        <form class="form-stack" method="post" action="<?= BASE_URL ?>/admin/criar_usuario.php">
            <label>Nome completo <input type="text" name="nome" required></label>
            <label>E-mail corporativo <input type="email" name="email" required></label>
            <label>Senha <input type="password" name="senha" required></label>
            <label>Nível de acesso
                <select name="nivel_acesso">
                    <option value="cliente">Cliente</option>
                    <option value="admin">Administrador</option>
                </select>
            </label>
            <button class="button button-primary" type="submit">Cadastrar usuário</button>
        </form>
    </main>
</body>
</html>