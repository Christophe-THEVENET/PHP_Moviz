<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$data = json_decode(file_get_contents('php://input'), true);

$reviewId = (int)$data['review_id'];
$reviewApprouved = (int)$data['review_approuved'];

try {

    $pdo = new PDO("mysql:dbname=" . _DB_NAME_ . ";host=db;charset=utf8mb4", _DB_USER_, _DB_PASSWORD_);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('UPDATE review SET approuved = :approuved WHERE id = :id');

    $stmt->bindParam(':id', $reviewId, $pdo::PARAM_INT);
    $stmt->bindParam(':approuved', $reviewApprouved, $pdo::PARAM_INT);
    $result = $stmt->execute();

    if (!$result) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to insert data into database']);
        exit;
    } else {
        echo json_encode(['success' => 'Changement de statut d\'approbation effectué avec succès ']);
        http_response_code(200);
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
}
