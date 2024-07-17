<?php

namespace App\Security;

use App\Entity\User;


class Security
{
    public static function verifyPassword(string $password, User $user): bool
    {
        if (password_verify($password, $user->getPassword())) {
            return true;
        } else {
            return false;
        }
    }

    public static function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function isUser(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['roles'] === 'user';
    }

    public static function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['roles'] === ROLE_ADMIN;
    }

    public static function getCurrentUserId(): int|bool
    {
        return (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : false;
    }

    public static function navigateTo(string $controller, string $action): string
    {
        return 'index.php?controller=' . $controller . '&action=' . $action;
    }
}
