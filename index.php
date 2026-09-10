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

header('Location: ' . BASE_URL . '/login.php');
exit;