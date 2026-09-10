<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

if (($_SESSION['nivel_acesso'] ?? null) !== 'admin') {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['senha'] ?? '';
    $level = $_POST['nivel_acesso'] ?? 'cliente';

    $statement = $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash, nivel_acesso) VALUES (?, ?, ?, ?)');
    $statement->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), $level]);

    header('Location: ' . BASE_URL . '/admin/listar_usuarios.php');
    exit;
}

require __DIR__ . '/../views/admin/criar_usuario.php';