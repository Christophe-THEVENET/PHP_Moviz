<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Security\Security;

class AuthController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                match ($_GET['action']) {
                    'login' => $this->login(),
                    'logout' => $this->logout(),
                    default => throw new \Exception("Cette action n'existe pas : " . $_GET['action']),
                };
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function login()
    {
        $errors = [];

        if (isset($_POST['loginUser'])) {

            $userRepository = new UserRepository();
            $user = $userRepository->findOneByEmail($_POST['email']);

            if ($user && Security::verifyPassword($_POST['password'], $user)) {
                // Regénère l'id session pour éviter la fixation de session
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'nickname' => $user->getNickname(),
                    'roles' => $user->getRoles(),
                ];

                Security::isAdmin() ? header('location:' . Security::navigateTo('admin', 'admin'))  : header('location: index.php');

            } else {
                $errors[] = 'Email ou mot de passe incorrect';
            }
        }

        $this->render('auth/login', [
            'errors' => $errors,
        ]);
    }

    protected function logout()
    {
        //Prévient les attaques de fixation de session
        session_regenerate_id(true);
        //Supprime les données de session du serveur
        session_destroy();
        //Supprime les données du tableau $_SESSION
        unset($_SESSION);
        header('location: index.php?controller=auth&action=login');
    }
}
