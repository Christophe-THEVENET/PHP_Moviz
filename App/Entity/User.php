<?php

namespace App\Entity;

class User extends Entity
{
    protected ?int $id = null;
    protected ?string $email = '';
    protected ?string $password = '';
    protected ?string $nickname = '';
    protected ?string $roles = '';

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
    public function setNickname($nickname)
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

    /*
        Pourrait être déplacé dans une classe UserValidator
    */
    public function validate(): array
    {
        $errors = [];

        if (empty($this->getNickname())) {
            $errors['nickname'] = 'Le champ pseudo ne doit pas être vide';
        }
        if (empty($this->getEmail())) {
            $errors['email'] = 'Le champ email ne doit pas être vide';
        } else if (!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'L\'email n\'est pas valide';
        }
        if (empty($this->getPassword())) {
            $errors['password'] = 'Le champ mot de passe ne doit pas être vide';
        }
        return $errors;
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public function verifyPassword(string $password): bool
    {
        if (password_verify($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function isUser(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['roles'] === 'user';
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['roles'] === 'admin';
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function getCurrentUserId(): int|bool
    {
        return (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : false;
    }
}
