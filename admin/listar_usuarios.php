<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

if (($_SESSION['nivel_acesso'] ?? null) !== 'admin') {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$statement = $pdo->query('SELECT id_usuario, nome, email, saldo_creditos, status_conta FROM usuarios ORDER BY data_cadastro DESC');
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
require __DIR__ . '/../views/admin/listar_usuarios.php';