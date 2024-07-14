<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);;
        } else {
            return false;
        }
    }
    public function findOneByEmail(string $email)
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);;
        } else {
            return false;
        }
    }

    public function persist(User $user)
    {

        if ($user->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE user SET nickname = :nickname,  email = :email, password = :password WHERE id = :id'
            );
            $query->bindValue(':id', $user->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                'INSERT INTO user (nickname, email, password, roles) VALUES (:nickname, :email, :password, :roles)'
            );
            $query->bindValue(':roles', $user->getRoles(), $this->pdo::PARAM_STR);
        }

        $query->bindValue(':nickname', $user->getNickname(), $this->pdo::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), $this->pdo::PARAM_STR);
        $query->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), $this->pdo::PARAM_STR);

        return $query->execute();
    }



    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM user");
        $query->execute();
        $users = $query->fetchAll($this->pdo::FETCH_ASSOC);
        if ($users) {
            return $users;
        } else {
            return false;
        }
    }




}
