<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$data = json_decode(file_get_contents('php://input'), true);
$reviewId = $data['review_id'];

try {
    $pdo = new PDO('mysql:host=db;dbname=moviz_db', 'test', 'test');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('DELETE FROM review WHERE id = :id');
    $stmt->bindValue(":id", $reviewId, PDO::PARAM_INT);
    $result = $stmt->execute();

    if (!$result) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to insert data into database']);
        exit;
    } else {
        echo json_encode(['success' => 'Suppression de votre commentaire réalisée avec succès ']);
        http_response_code(200);
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
}
