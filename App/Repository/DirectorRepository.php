<?php

namespace App\Repository;

use App\Entity\Director;
use PDO;

class DirectorRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM director WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $director = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($director) {
            return Director::createAndHydrate($director);
        } else {
            return false;
        }
    }

    public function persist(Director $director)
    {

        if ($director->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE director SET first_name = :first_name, last_name = :last_name WHERE id = :id'
            );
            $query->bindValue(':id', $director->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                "INSERT INTO director (first_name, last_name) VALUES (:first_name, :last_name)"
            );
        }

        $query->bindValue(':first_name', $director->getFirstName(), $this->pdo::PARAM_STR);
        $query->bindValue(':last_name', $director->getLastName(), $this->pdo::PARAM_STR);

        $query->execute();

        $last_id = $this->pdo->lastInsertId();
        return $last_id;
    }

    public function findAll(int $limit = null, int $page = null): array|bool
    {

        $sql = "SELECT * FROM director ORDER BY director.id DESC";

        if ($limit && !$page) {
            $sql .= " LIMIT  :limit";
        }
        if ($limit && $page) {
            $sql .= " LIMIT :offest, :limit";
        }

        $query = $this->pdo->prepare($sql);

        if ($limit) {
            $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        }
        if ($page) {
            $offset = ($page - 1) * $limit;
            $query->bindValue(":offest", $offset, PDO::PARAM_INT);
        }

        $query->execute();

        $directors = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $directorsArray = [];
        if ($directors) {
            foreach ($directors as $director) {
                $directorsArray[] = Director::createAndHydrate($director);
            }
            return $directorsArray;
        } else {
            return false;
        }
    }

    public function getTotalDirector(): int|bool
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) as total FROM director");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function delete(Director $director): bool
    {

        $query = $this->pdo->prepare("DELETE FROM director WHERE id = :id");
        $query->bindValue(':id', $director->getId(), $this->pdo::PARAM_INT);

        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findAllByMovieId(int $movie_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM director d
                                      LEFT JOIN movie_director md ON md.director_id = d.id
                                      WHERE md.movie_id = :movie_id");
        $query->bindParam(':movie_id', $movie_id, $this->pdo::PARAM_STR);
        $query->execute();
        $directors = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $directorsArray = [];

        if ($directors) {
            foreach ($directors as $director) {
                $directorsArray[] = Director::createAndHydrate($director);
            }
        }

        return $directorsArray;
    }

    public function linkDirectorsByMovie(int $movie_id, int $director_id)
    {
        // Vérification si l'enregistrement existe déjà dans la table
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM movie_director WHERE director_id = :director_id AND movie_id = :movie_id");
        $query->execute(['director_id' => $director_id, 'movie_id' => $movie_id]);
        $count = $query->fetchColumn();

        if ($count > 0) {
        } else {
            $query = $this->pdo->prepare('INSERT INTO movie_director (movie_id, director_id) VALUES (:movie_id, :director_id)');
        $query->bindParam(':movie_id', $movie_id, $this->pdo::PARAM_STR);
        $query->bindParam(':director_id', $director_id, $this->pdo::PARAM_STR);
        }

        return $query->execute();
    }

    public function unLinkDirectorsByMovie(int $movieId, int $directorId)
    {
        $query = $this->pdo->prepare('DELETE FROM movie_director (movie_id, director_id) VALUES (:movie_id, :director_id)');
        $query->bindParam(':movie_id', $movieId, $this->pdo::PARAM_STR);
        $query->bindParam(':director_id', $directorId, $this->pdo::PARAM_STR);

        return $query->execute();
    }



}
