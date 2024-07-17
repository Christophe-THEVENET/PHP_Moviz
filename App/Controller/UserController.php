<?php

namespace App\Controller;

require_once 'config.php';

use App\Repository\UserRepository;
use App\Entity\User;
use App\Security\Security;
use App\Security\UserValidator;
use App\Controller\AuthController;
use DateTime;

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

                    $_POST['loginUser'] = $_POST['saveUser'];
                    $authController = new AuthController();
                    $authController->login();
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

    public function userAddUpdate()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                // user vide pour pouvoir afficher ajouter un user
                $user = [
                    'email' => '',
                    'password' => '',
                    'nickname' => '',
                    'roles' => '',
                ];

                // ***************** get user for update ********************
                if (isset($_GET['id'])) {

                    $userRepository = new UserRepository();
                    $user = $userRepository->findOneById($_GET['id']);

                    $user = [
                        'id' => $user->getId(),
                        'email' => $user->getEmail(),
                        'password' => $user->getPassword(),
                        'nickname' => $user->getNickname(),
                        'roles' => $user->getRoles(),
                    ];

                    if ($user === false) {
                        $errors[] = "L'utilisateur n\'existe pas";
                    }
                    $pageTitle = "Modifier l'utilisateur: " . $user['nickname'];
                } else {
                    $pageTitle = "Ajouter un utilisateur";
                }


                // ***************** save user ********************
                if (isset($_POST['saveUser'])) {

                    if (isset($user['id'])) {
                        $_POST['id'] = $user['id'];
                    };


                    $userObject = new User();
                    $userValidator = new UserValidator();
                    $userObject->hydrate($_POST);

                    $errors = $userValidator->validate($userObject);

                    if (empty($errors)) {
                        $userRepository = new UserRepository();

                        $userRepository->persist($userObject);

                        if (isset($user['id'])) {
                            $messages[] = 'Modification d\'utilisateur réussi !';
                            $user = [
                                'id' => '',
                                'email' => '',
                                'password' => '',
                                'nickname' => '',
                                'roles' => '',
                            ];
                        } else {
                            $messages[] = 'Ajout d\'utilisateur réussi !';
                        };
                    }
                     $_SESSION['messages'] = $messages;
                header('location:' . Security::navigateTo('admin', 'users')); 
                }

               
                $this->render('admin/user-add-update', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'user' => $user,
                    'pageTitle' => $pageTitle
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
