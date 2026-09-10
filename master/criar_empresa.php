<?php
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if (($_SESSION['nivel_acesso'] ?? null) !== 'master') {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->beginTransaction();
    try {
        $companyStatement = $pdo->prepare('INSERT INTO empresas (nome_empresa, cnpj) VALUES (?, ?)');
        $companyStatement->execute([trim($_POST['nome_empresa'] ?? ''), trim($_POST['cnpj'] ?? '')]);
        $companyId = (int) $pdo->lastInsertId();

        $userStatement = $pdo->prepare(
            'INSERT INTO usuarios (id_empresa, nome, email, senha_hash, nivel_acesso) VALUES (?, ?, ?, ?, "empresa")'
        );
        $userStatement->execute([
            $companyId,
            trim($_POST['nome_gestor'] ?? ''),
            trim($_POST['email'] ?? ''),
            password_hash($_POST['senha'] ?? '', PASSWORD_DEFAULT),
        ]);
        $pdo->commit();
        header('Location: ' . BASE_URL . '/master/index.php');
        exit;
    } catch (Throwable $exception) {
        $pdo->rollBack();
        $error = 'Não foi possível cadastrar a empresa. Verifique se o CNPJ e o e-mail já existem.';
    }
}

require __DIR__ . '/../views/master/criar_empresa.php';