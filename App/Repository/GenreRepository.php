<?php

namespace App\Repository;

use App\Entity\Genre;
use PDO;

class GenreRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM genre WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $genre = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($genre) {
            return Genre::createAndHydrate($genre);
        } else {
            return false;
        }
    }

    public function persist(Genre $genre)
    {

        if ($genre->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE genre SET `name` = :name WHERE id = :id'
            );
            $query->bindValue(':id', $genre->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                "INSERT INTO genre (`name`) VALUES (:name)"
            );
        }

        $query->bindValue(':name', $genre->getName(), $this->pdo::PARAM_STR);
      
        return $query->execute();
    }

    public function findAll(int $limit = null, int $page = null): array|bool
    {

        $sql = "SELECT * FROM genre ORDER BY genre.id DESC";

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

        $genres = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $genresArray = [];
        if ($genres) {
            foreach ($genres as $genre) {
                $genresArray[] = Genre::createAndHydrate($genre);
            }
            return $genresArray;
        } else {
            return false;
        }
    }

    public function getTotalGenre(): int|bool
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) as total FROM genre");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    function delete(genre $genre): bool
    {

        $query = $this->pdo->prepare("DELETE FROM genre WHERE id = :id");
        $query->bindValue(':id', $genre->getId(), $this->pdo::PARAM_INT);

        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
