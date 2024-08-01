<?php

namespace App\Repository;

use PDO;

class MovieGenreRepository extends Repository
{

    public function persistGenresByFilm(int $movieId, array $genreIds)
    {
        // Delete existing records for the film in the junction table
        $query = $this->pdo->prepare("DELETE FROM movie_genre WHERE movie_id = :movie_id");
        $query->bindValue(':movie_id', $movieId);
        $query->execute();

        // Insert new records for the film in the junction table
        $query = $this->pdo->prepare('INSERT INTO movie_genre (movie_id, genre_id) VALUES (:film_id, :genre_id)');
        foreach ($genreIds as $genreId) {
            $query->bindValue(':film_id', $movieId);
            $query->bindValue(':genre_id', $genreId);
            $query->execute();
        }
    }
}
