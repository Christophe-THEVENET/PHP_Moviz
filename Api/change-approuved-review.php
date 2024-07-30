<?php
// Objectif: supprimer le lien entre un film est un réalisateur
// Récupérez les ID de director et movie à partir des données de la requête AJAX

use App\Repository\ReviewRepository;

$reviewId = $_POST['review_id'];
$reviewApprouved = $_POST['review_approuved'];


/* $reviewRepository = new ReviewRepository(); */


/* $reviewRepository->approuveReview($reviewId, $reviewApprouved); */


$pdo = new PDO('mysql:host=db;dbname=moviz_db', 'test', 'test');
$stmt = $pdo->prepare('UPDATE review SET approuved = :approuved WHERE id = :id');
$stmt->execute(['id' => $reviewId, 'approuved' => $reviewApprouved]);

// Send a response to the client
http_response_code(200);
