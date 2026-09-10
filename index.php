<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (isset($_SESSION['id_usuario'])) {
    header('Location: ' . BASE_URL . '/cliente/index.php');
    exit;
}

header('Location: ' . BASE_URL . '/login.php');
exit;