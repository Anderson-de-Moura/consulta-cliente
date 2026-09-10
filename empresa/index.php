<?php
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if (!in_array($_SESSION['nivel_acesso'] ?? null, ['empresa'], true) || empty($_SESSION['id_empresa'])) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$companyStatement = $pdo->prepare('SELECT nome_empresa, cnpj, status_contrato FROM empresas WHERE id_empresa = ?');
$companyStatement->execute([$_SESSION['id_empresa']]);
$company = $companyStatement->fetch(PDO::FETCH_ASSOC);
$usersStatement = $pdo->prepare(
    "SELECT id_usuario, nome, email, nivel_acesso, status_conta, data_cadastro
     FROM usuarios WHERE id_empresa = ? ORDER BY data_cadastro DESC"
);
$usersStatement->execute([$_SESSION['id_empresa']]);
$users = $usersStatement->fetchAll(PDO::FETCH_ASSOC);
require __DIR__ . '/../views/empresa/index.php';