<?php
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if (($_SESSION['nivel_acesso'] ?? null) !== 'empresa' || empty($_SESSION['id_empresa'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statement = $pdo->prepare(
        'INSERT INTO usuarios (id_empresa, nome, email, senha_hash, nivel_acesso) VALUES (?, ?, ?, ?, "operador")'
    );
    $statement->execute([
        $_SESSION['id_empresa'],
        trim($_POST['nome'] ?? ''),
        trim($_POST['email'] ?? ''),
        password_hash($_POST['senha'] ?? '', PASSWORD_DEFAULT),
    ]);
    header('Location: ' . BASE_URL . '/empresa/index.php');
    exit;
}
require __DIR__ . '/../views/empresa/criar_usuario.php';