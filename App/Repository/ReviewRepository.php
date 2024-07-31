<?php

namespace App\Repository;

use App\Entity\Review;
use DateTime;
use PDO;

class ReviewRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM review WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $review = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($review) {
            return Review::createAndHydrate($review);
        } else {
            return false;
        }
    }

    public function findAllByMovieId(int $movie_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM review WHERE movie_id = :movie_id AND approuved = :approuved ORDER BY created_at DESC");
        $query->bindParam(':movie_id', $movie_id, $this->pdo::PARAM_INT);
        $query->bindValue(':approuved', 1, $this->pdo::PARAM_INT);
        $query->execute();
        $reviews = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $reviewsArray = [];

        if ($reviews) {
            foreach ($reviews as $review) {
                $reviewsArray[] = Review::createAndHydrate($review);
            }
        }
        return $reviewsArray;
    }

    public function findAllByUserId(int $user_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM review WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id, $this->pdo::PARAM_INT);
        $query->execute();
        $reviews = $query->fetchAll($this->pdo::FETCH_ASSOC);

        $reviewsArray = [];

        if ($reviews) {
            foreach ($reviews as $review) {
                $reviewsArray[] = Review::createAndHydrate($review);
            }
        }
        return $reviewsArray;
    }

    public function persist(Review $review)
    {

        if ($review->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE review SET user_id = :user_id, movie_id = :movie_id, rate = :rate, review = :review, approuved = :approuved WHERE id = :id'
            );
            $query->bindValue(':id', $review->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                "INSERT INTO review (user_id, movie_id, rate, review, approuved, created_at) VALUES (:user_id, :movie_id, :rate, :review, :approuved, NOW())"
            );
        }

        $query->bindValue(':user_id', $review->getUserId(), $this->pdo::PARAM_INT);
        $query->bindValue(':movie_id', $review->getMovieId(), $this->pdo::PARAM_INT);
        $query->bindValue(':rate', $review->getRate(), $this->pdo::PARAM_INT);
        $query->bindValue(':review', $review->getReview(), $this->pdo::PARAM_STR);
        $query->bindValue(':approuved', $review->getApprouved(), $this->pdo::PARAM_INT);

        return $query->execute();
    }

    public function findAll(int $limit = null, int $page = null): array|bool
    {

        $sql = "SELECT * FROM review ORDER BY created_at DESC";

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

        $reviews = $query->fetchAll($this->pdo::FETCH_ASSOC);



        $reviewsArray = [];
        if ($reviews) {
            foreach ($reviews as $review) {
                $reviewsArray[] = Review::createAndHydrate($review);
            }

            return $reviewsArray;
        } else {
            return false;
        }
    }

    function delete(Review $review): bool
    {

        $query = $this->pdo->prepare("DELETE FROM review WHERE id = :id");
        $query->bindValue(':id', $review->getId(), $this->pdo::PARAM_INT);

        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getAverageRatingForMovie(int $movieId): ?float
    {
        $query = $this->pdo->prepare("SELECT movie_id, AVG(rate) AS average_rating FROM review WHERE movie_id = :movie_id GROUP BY movie_id");
        $query->bindParam(':movie_id', $movieId, $this->pdo::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['average_rating'];
        }
        return null;
    }

    public function getTotalReview(): int|bool
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) as total FROM review");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function approuveReview(int $reviewId, int $approuvedValue)
    {

        $query = $this->pdo->prepare(
            'UPDATE review SET approuved = :approuved WHERE id = :id'
        );

        $query->bindValue(':id', $reviewId, $this->pdo::PARAM_INT);
        $query->bindValue(':approuved', $approuvedValue, $this->pdo::PARAM_INT);

        return $query->execute();
    }
}

