<?php

namespace App\Entity;

use DateTime;

class User extends Entity
{
    protected ?int $id = null;
    protected ?string $email = '';
    protected ?string $password = '';
    protected ?string $nickname = '';
    protected ?string $roles = '';
    protected ?string $createdAt = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     *
     * @return  self
     */
    public function setNickname($nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRoles(): ?string
    {
        return $this->roles;
    }

    /**
     * Set the value of role
     */
    public function setRoles(?string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt(?string $createdAt):self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
