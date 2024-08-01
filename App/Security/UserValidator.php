<?php

namespace App\Security;

use App\Entity\User;

class UserValidator
{

    public function validate(User $user): array
    {
        $errors = [];

        if (empty($user->getNickname())) {
            $errors['nickname'] = 'Le champ pseudo ne doit pas être vide';
        }
        if (empty($user->getEmail())) {
            $errors['email'] = 'Le champ email ne doit pas être vide';
        } else if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'L\'email n\'est pas valide';
        }
        if (empty($user->getPassword())) {
            $errors['password'] = 'Le champ mot de passe ne doit pas être vide';
        }
        return $errors;
    }
}
