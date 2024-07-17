<?php

namespace App\Controller;

use App\Security\Security;
use App\Controller\UserController;


require_once 'config.php';


class AdminController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                match ($_GET['action']) {
                    'admin' =>  $this->admin(),
                    'users' => [
                        $userController = new UserController(),
                        $userController->usersList(),
                    ],
                    'user' => [
                        $userController = new UserController(),
                        $userController->userAddUpdate(),
                    ],
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
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                $this->render('admin/admin', [

                    'errors' => $errors,
                    'messages' => $messages,
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
