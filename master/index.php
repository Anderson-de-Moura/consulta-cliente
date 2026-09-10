<?php
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if (($_SESSION['nivel_acesso'] ?? null) !== 'master') {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$companies = $pdo->query(
    "SELECT e.id_empresa, e.nome_empresa, e.cnpj, e.status_contrato,
            COUNT(u.id_usuario) AS total_usuarios
     FROM empresas e LEFT JOIN usuarios u ON u.id_empresa = e.id_empresa
     GROUP BY e.id_empresa ORDER BY e.nome_empresa"
)->fetchAll(PDO::FETCH_ASSOC);
require __DIR__ . '/../views/master/index.php';