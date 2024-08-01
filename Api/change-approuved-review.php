<?php
// récup requete ajax post
$reviewId = $_POST['review_id'];
$reviewApprouved = $_POST['review_approuved'];

$pdo = new PDO('mysql:host=db;dbname=_DB_NAME_', '_DB_USER_', '_DB_PASSWORD_');
$stmt = $pdo->prepare('UPDATE review SET approuved = :approuved WHERE id = :id');
$stmt->execute(['id' => $reviewId, 'approuved' => $reviewApprouved]);

http_response_code(200);
