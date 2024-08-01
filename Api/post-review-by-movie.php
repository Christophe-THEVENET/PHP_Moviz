<?php

$dataArray = json_decode(file_get_contents('php://input'), true);

if (!isset($dataArray['rate']) || !isset($dataArray['user_id']) || !isset($dataArray['movie_id']) || !isset($dataArray['review']) || !isset($dataArray['approuved'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$userId = (int)$dataArray['user_id'];
$movieId = (int)$dataArray['movie_id'];
$rate = (int)$dataArray['rate'];
$review = $dataArray['review'];
$approuved = (int)$dataArray['approuved'];

try {

    $pdo = new PDO('mysql:host=db;dbname=moviz_db', 'test', 'test');

    $stmt = $pdo->prepare('INSERT INTO review (user_id, movie_id, rate, review, approuved, created_at) VALUES (:user_id, :movie_id, :rate, :review, :approuved, NOW())');

    $stmt->bindParam(':user_id', $userId, $pdo::PARAM_INT);
    $stmt->bindParam(':movie_id', $movieId, $pdo::PARAM_INT);
    $stmt->bindParam(':rate', $rate, $pdo::PARAM_INT);
    $stmt->bindParam(':review', $review, $pdo::PARAM_STR);
    $stmt->bindParam(':approuved', $approuved, $pdo::PARAM_INT);

    $result = $stmt->execute();

    if (!$result) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to insert data into database']);
        exit;
    } else {
        echo json_encode(['success' => 'Votre commentaire est en attente d\'approbation.']);
         http_response_code(200);
    }
   
} catch (PDOException $e) {
    error_log($e->getMessage());
}
