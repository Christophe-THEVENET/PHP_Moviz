<?php
namespace App\Controller;

require_once 'config.php';

use App\Repository\UserRepository;
use App\Entity\User;
use App\Security\Security;
use App\Security\UserValidator;

class UserController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                match ($_GET['action']) {
                    'register' =>  $this->register(),
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

    protected function register()
    {
        try {
            $errors = [];
            $messages = [];
            $user = new User();
            $userValidator = new UserValidator();

            if (isset($_POST['saveUser'])) {

                $user->hydrate($_POST);
                $user->setRoles(ROLE_USER);
                
                $errors = $userValidator->validate($user);

                if (empty($errors)) {
                    $userRepository = new UserRepository();

                    $userRepository->persist($user);
                    $messages[] = 'Inscription réussie !';
                    header('Location: index.php?controller=auth&action=login'); 
                }
            }

            $this->render('user/add_edit', [
                'user' => '',
                'pageTitle' => 'Inscription',
                'errors' => $errors,
                'messages' => $messages,
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function usersList()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                $userRepository = new UserRepository();
                $users = $userRepository->findAll();

                $this->render('admin/users-list', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'users' => $users,
                ]);
            } else {
                header('location:' . Security::navigateTo('page', 'home'));
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }


}
