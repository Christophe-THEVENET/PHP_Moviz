<?php

namespace App\Entity;

use DateTime;

class Review extends Entity
{
    protected ?int $id = null;
    protected ?int $userId = null;
    protected ?int $movieId = null;
    protected ?int $rate = null;
    protected ?string $review = '';
    protected ?string $createdAt = null;
    protected ?int $approuved = 0;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId($userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getMovieId(): ?int
    {
        return $this->movieId;
    }

    public function setMovieId($movieId): self
    {
        $this->movieId = $movieId;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate($rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview($review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getApprouved(): ?int
    {
        return $this->approuved;
    }

    public function setApprouved($approuved): self
    {
        if ($approuved === null) {
            $approuved = 0;
        }
        $this->approuved = $approuved;
        return $this;

        return $this;
    }
}
