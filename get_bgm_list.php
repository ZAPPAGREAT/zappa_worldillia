<?php
require_once 'config/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM bgm_tracks ORDER BY created_at DESC");
    $bgm_tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($bgm_tracks);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?> 