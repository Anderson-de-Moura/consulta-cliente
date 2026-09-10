<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

if (!in_array($_SESSION['nivel_acesso'] ?? null, ['admin', 'cliente'], true)) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

$csrfToken = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrfToken;
$flash = $_SESSION['consultation_flash'] ?? null;
unset($_SESSION['consultation_flash']);
$consultationMessage = $flash['message'] ?? '';
$consultedCpf = $flash['cpf'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedToken = $_POST['csrf_token'] ?? '';
    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $legalBasis = $_POST['justificativa_lgpd'] ?? '';
    $allowedLegalBases = ['protecao_credito', 'prevencao_fraude', 'cobranca'];

    if (!hash_equals($csrfToken, $submittedToken)) {
        $_SESSION['consultation_flash'] = [
            'message' => 'Sua sessão expirou. Atualize a página e tente novamente.',
            'cpf' => '',
        ];
    } elseif (strlen($cpf) !== 11) {
        $_SESSION['consultation_flash'] = [
            'message' => 'Informe um CPF válido com 11 dígitos.',
            'cpf' => '',
        ];
    } elseif (!in_array($legalBasis, $allowedLegalBases, true)) {
        $_SESSION['consultation_flash'] = [
            'message' => 'Selecione a justificativa legal da consulta.',
            'cpf' => '',
        ];
    } else {
        $consultationStatement = $pdo->prepare(
            'INSERT INTO consultas (id_usuario, cpf_hash, cpf_mascarado, justificativa_lgpd, status_consulta) VALUES (?, ?, ?, ?, ?)'
        );
        $consultationStatement->execute([
            $_SESSION['id_usuario'],
            hash('sha256', $cpf),
            substr($cpf, 0, 3) . '.***.***-**',
            $legalBasis,
            'aguardando_integracao',
        ]);
        $_SESSION['consultation_flash'] = [
            'message' => 'Consulta registrada. A integração com a fonte de dados ainda não foi configurada.',
            'cpf' => $cpf,
        ];
    }

    header('Location: ' . BASE_URL . '/cliente/index.php');
    exit;
}

$statement = $pdo->prepare('SELECT saldo_creditos FROM usuarios WHERE id_usuario = ?');
$statement->execute([$_SESSION['id_usuario']]);
$userData = $statement->fetch(PDO::FETCH_ASSOC);
$balance = (int) ($userData['saldo_creditos'] ?? 0);

$historyStatement = $pdo->prepare(
    "SELECT cpf_mascarado, justificativa_lgpd, status_consulta, data_consulta
     FROM consultas
     WHERE id_usuario = ?
     ORDER BY data_consulta DESC
     LIMIT 5"
);
$historyStatement->execute([$_SESSION['id_usuario']]);
$history = $historyStatement->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/../views/cliente/index.php';