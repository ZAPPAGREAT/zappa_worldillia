<?php
require_once 'config/database.php';

// POSTデータを取得
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    try {
        $stmt = $pdo->prepare("INSERT INTO download_history (track_id, user_name, usage_purpose, feedback) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['track_id'],
            $data['user_name'],
            $data['usage_purpose'],
            $data['feedback']
        ]);
        
        http_response_code(200);
        echo json_encode(['message' => 'ダウンロード記録が保存されました']);
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'データベースエラー: ' . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => '無効なリクエストです']);
}
?> 