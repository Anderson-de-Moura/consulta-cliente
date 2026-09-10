<?php
declare(strict_types=1);

session_start();

$scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$scriptDirectory = preg_replace('~/(admin|cliente)$~', '', $scriptDirectory) ?: '';
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