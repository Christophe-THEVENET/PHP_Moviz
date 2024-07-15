<?php

namespace App\Controller;

require_once 'config.php';


class AdminController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                match ($_GET['action']) {
                    'admin' =>  $this->admin(),
                        /*  'delete' => */ // Appeler méthode delete(),
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

    protected function admin()
    {
        try {
            $errors = [];
            $messages = [];
          /*   $user = new User();
            $userValidator = new UserValidator(); */

            if (isset($_POST['saveUser'])) {

            /*     $user->hydrate($_POST);
                $user->setRoles(ROLE_USER); */
/* 
                $errors = $userValidator->validate($user); */

                if (empty($errors)) {
                  /*   $userRepository = new UserRepository();

                    $userRepository->persist($user); */
                    $messages[] = 'Inscription réussie !';
                    header('Location: index.php?controller=auth&action=login');
                }
            }

            $this->render('admin/admin', [
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
}
