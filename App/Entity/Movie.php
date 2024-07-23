<?php

namespace App\Entity;

class Movie extends Entity
{

    protected ?int $id = null;
    protected ?string $name = '';
    protected ?string $synopsys = '';
    protected ?string $releaseYear;
    protected ?string $duration;
    protected ?string $imageName = '';

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of title
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of synopsys
     */
    public function getSynopsys(): ?string
    {
        return $this->synopsys;
    }

    /**
     * Set the value of synopsys
     */
    public function setSynopsys(?string $synopsys): self
    {
        $this->synopsys = $synopsys;

        return $this;
    }

    /**
     * Get the value of release_date
     */
    public function getReleaseYear(): ?string
    {
        return $this->releaseYear;
    }

    /**
     * Set the value of release_date
     */
    public function setReleaseYear(string $releaseYear): self
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    /**
     * Get the value of duration
     */
    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     */
    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of image_name
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * Set the value of image_name
     */
    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImagePath():string
    {
        if ($this->getImageName()) {
            return MOVIES_IMAGES_FOLDER.$this->getImageName();
        } else {
            return ASSETS_IMAGES_FOLDER."default-movie.png";
        }
    }


}