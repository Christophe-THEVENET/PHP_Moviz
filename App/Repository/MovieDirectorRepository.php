<?php

namespace App\Repository;

use PDO;
use PDOException;

class MovieDirectorRepository extends Repository
{


    public function persistDirectorByMovie(int $movieId, array $genreIds)
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

    public function checkDirectorIsInBdd(array $directors, int $movieId = null)
    {

        $directorsToPersist = [];
        $directorToPersist = [];
        foreach ($directors as $director) {
            $firstName = $director['first_name'];
            $lastName = $director['last_name'];

            $query = $this->pdo->prepare("SELECT COUNT(*) FROM director WHERE first_name = :first_name AND last_name = :last_name");
            $query->bindParam(':first_name', $firstName);
            $query->bindParam(':last_name', $lastName);
            $query->execute();

            $count = $query->fetchColumn();
            $last_id = $this->pdo->lastInsertId();

            if ($count > 0) {
                $query = $this->pdo->prepare("SELECT id FROM director WHERE first_name = :first_name AND last_name = :last_name");
                $query->bindParam(':first_name', $firstName);
                $query->bindParam(':last_name', $lastName);
                $query->execute();
                $directorId = $query->fetchColumn();

                $directorRepository = new DirectorRepository();
                $directorRepository->linkDirectorsByMovie($movieId, $directorId);
            } else {
                $directorToPersist['first_name'] = $firstName;
                $directorToPersist['last_name'] = $lastName;
                $directorsToPersist[] = $directorToPersist;
            }
        }
        return $directorsToPersist;
    }
}
