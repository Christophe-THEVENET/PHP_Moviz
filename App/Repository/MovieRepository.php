<?php

namespace App\Repository;

use App\Entity\Movie;
use PDO;

class MovieRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM movie WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $movie = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($movie) {
            return movie::createAndHydrate($movie);
        } else {
            return false;
        }
    }

    public function persist(Movie $movie)
    {

        if ($movie->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE movie SET `name` = :name, release_year = :release_year, synopsys = :synopsys, duration = :duration, image_name = :image_name WHERE id = :id'
            );
            $query->bindValue(':id', $movie->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                "INSERT INTO movie (`name`,release_year,synopsys,duration,image_name  ) VALUES (:name, :release_year, :synopsys, :duration, :image_name)"
            );
        }

        $query->bindValue(':name', $movie->getName(), $this->pdo::PARAM_STR);
        $query->bindValue(':release_year', $movie->getReleaseYear(), $this->pdo::PARAM_STR);
        $query->bindValue(':synopsys', $movie->getSynopsys(), $this->pdo::PARAM_STR);
        $query->bindValue(':duration', $movie->getDuration(), $this->pdo::PARAM_STR);
        $query->bindValue(':image_name', $movie->getImageName(), $this->pdo::PARAM_STR);

        return $query->execute();
    }

    public function findAll(int $limit = null, int $page = null): array|bool
    {

        $sql = "SELECT * FROM movie ORDER BY movie.id DESC";

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

        $movies = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $moviesArray = [];
        if ($movies) {
            foreach ($movies as $movie) {
                $moviesArray[] = Movie::createAndHydrate($movie);
            }
            return $moviesArray;
        } else {
            return false;
        }
    }

    public function getTotalMovie(): int|bool
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) as total FROM movie");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function delete(movie $movie): bool
    {

        $query = $this->pdo->prepare("DELETE FROM movie WHERE id = :id");
        $query->bindValue(':id', $movie->getId(), $this->pdo::PARAM_INT);

        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
