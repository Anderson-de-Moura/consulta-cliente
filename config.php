<?php
declare(strict_types=1);

session_start();

$scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$scriptDirectory = preg_replace('~/(admin|cliente|master|empresa|operador)$~', '', $scriptDirectory) ?: '';
define('BASE_URL', $scriptDirectory === '/' ? '' : rtrim($scriptDirectory, '/'));

$host = 'localhost';
$database = 'consultacpf';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados.');
}

if (isset($_SESSION['id_usuario'])) {
    $sessionUserStatement = $pdo->prepare(
        'SELECT id_usuario, id_empresa, nome, nivel_acesso, status_conta FROM usuarios WHERE id_usuario = ?'
    );
    $sessionUserStatement->execute([$_SESSION['id_usuario']]);
    $sessionUser = $sessionUserStatement->fetch(PDO::FETCH_ASSOC);

    if (!$sessionUser || $sessionUser['status_conta'] !== 'ativo') {
        $_SESSION = [];
        session_destroy();
    } else {
        // Atualiza sessões antigas após mudanças de papel ou empresa.
        $_SESSION['id_usuario'] = $sessionUser['id_usuario'];
        $_SESSION['id_empresa'] = $sessionUser['id_empresa'];
        $_SESSION['nome'] = $sessionUser['nome'];
        $_SESSION['nivel_acesso'] = $sessionUser['nivel_acesso'];
    }
}