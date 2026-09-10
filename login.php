<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (isset($_SESSION['id_usuario'])) {
    $destination = match ($_SESSION['nivel_acesso'] ?? '') {
        'master' => '/master/index.php',
        'empresa' => '/empresa/index.php',
        default => '/operador/index.php',
    };
    header('Location: ' . BASE_URL . $destination);
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['senha'] ?? '');

    $statement = $pdo->prepare('SELECT id_usuario, id_empresa, nome, senha_hash, nivel_acesso, status_conta FROM usuarios WHERE email = ?');
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['senha_hash'])) {
        $error = 'E-mail ou senha incorretos.';
    } elseif ($user['status_conta'] === 'bloqueado') {
        $error = 'Sua conta está bloqueada. Entre em contato com o suporte.';
    } else {
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['id_empresa'] = $user['id_empresa'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['nivel_acesso'] = $user['nivel_acesso'];

        $destination = match ($user['nivel_acesso']) {
            'master' => '/master/index.php',
            'empresa' => '/empresa/index.php',
            default => '/operador/index.php',
        };
        header('Location: ' . BASE_URL . $destination);
        exit;
    }
}

require __DIR__ . '/views/auth/login.php';