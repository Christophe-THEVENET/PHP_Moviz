<?php

namespace App\Repository;

use PDO;
use PDOException;

class MovieDirectorRepository extends Repository
{


    public function linkDirectorsByMovie(int $movieId, array $directorIds)
    {
        // Delete existing records for the film in the junction table
        $query = $this->pdo->prepare("DELETE FROM movie_director WHERE movie_id = :movie_id");
        $query->bindValue(':movie_id', $movieId);
        $query->execute();

        // Insert new records for the film in the junction table
        $query = $this->pdo->prepare('INSERT INTO movie_director (movie_id, director_id) VALUES (:movie_id, :director_id)');
        foreach ($directorIds as $genreId) {
            $query->bindValue(':movie_id', $movieId);
            $query->bindValue(':director_id', $genreId);
            $query->execute();
        }
    }

    public function checkDirectorsIsInBdd(array $directors)
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
            // si le réalisateur est en bdd
            if ($count > 0) {
                // si le réalisateur n'est pas en bdd retourne tableau de réalisateurs a persister
            } else {
                $directorToPersist['first_name'] = $firstName;
                $directorToPersist['last_name'] = $lastName;
                $directorsToPersist[] = $directorToPersist;
            }

        }
        return $directorsToPersist;
    }

    
}
