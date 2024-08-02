<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['rate']) || !isset($data['user_id']) || !isset($data['movie_id']) || !isset($data['review']) || !isset($data['approuved'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$userId = (int)$data['user_id'];
$movieId = (int)$data['movie_id'];
$rate = (int)$data['rate'];
$review = $data['review'];
$approuved = (int)$data['approuved'];

try {

    $pdo = new PDO("mysql:dbname=" . _DB_NAME_ . ";host=" . _DB_HOST_ . ";charset=utf8mb4", _DB_USER_, _DB_PASSWORD_);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

