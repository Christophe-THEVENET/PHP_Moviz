<?php

// Récupérer les données JSON de la requête
$data = json_decode(file_get_contents('php://input'), true);
$reviewId = $data['review_id'];

try {
    $pdo = new PDO('mysql:host=db;dbname=moviz_db', 'test', 'test');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('DELETE FROM review WHERE id = :id');
    $stmt->bindValue(":id", $reviewId, PDO::PARAM_INT);
    $stmt->execute();

    http_response_code(200);
    echo json_encode(['message' => 'Review deleted successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
