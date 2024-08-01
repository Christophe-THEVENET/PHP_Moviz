<?php
// Objectif: supprimer le lien entre un film est un réalisateur
// Récupérez les ID de director et movie à partir des données de la requête AJAX
$directorId = $_POST['director_id'];
$movieId = $_POST['movie_id'];

$pdo = new PDO('mysql:host=db;dbname=_DB_NAME_', '_DB_USER_', '_DB_PASSWORD_');
$stmt = $pdo->prepare('DELETE FROM movie_director WHERE director_id = :director_id AND movie_id = :movie_id');
$stmt->execute(['director_id' => $directorId, 'movie_id' => $movieId]);

// Envoyez une réponse au script JavaScript
http_response_code(200);
