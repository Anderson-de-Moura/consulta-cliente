<?php
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if (!in_array($_SESSION['nivel_acesso'] ?? null, ['operador'], true)) {
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}

require __DIR__ . '/../cliente/index.php';