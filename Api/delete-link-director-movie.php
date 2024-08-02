<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['director_id']) || !isset($data['movie_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$directorId = (int)$data['director_id'];
$movieId = (int)$data['movie_id'];

try {

    $pdo = new PDO("mysql:dbname=" . _DB_NAME_ . ";host=" . _DB_HOST_ . ";charset=utf8mb4", _DB_USER_, _DB_PASSWORD_);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('DELETE FROM movie_director WHERE director_id = :director_id AND movie_id = :movie_id');

    $stmt->bindParam(':director_id', $directorId, $pdo::PARAM_INT);
    $stmt->bindParam(':movie_id', $movieId, $pdo::PARAM_INT);
    $result = $stmt->execute();

    if (!$result) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to insert data into database']);
        exit;
    } else {
        echo json_encode(['success' => 'Suppression du réalisateur effectuée ']);
        http_response_code(200);
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
}
