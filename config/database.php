<?php
$host = 'localhost';
$dbname = 'zappa_worldillia';
$username = 'root';
$password = '283zappa';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "接続エラー: " . $e->getMessage();
    exit;
}
?> 