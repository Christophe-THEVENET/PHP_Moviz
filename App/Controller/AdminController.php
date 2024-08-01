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
                    'user-delete' => [
                        $userController = new UserController(),
                        $userController->userDelete(),
                    ],
                    'genres' => [
                        $genreController = new GenreController(),
                        $genreController->genresList(),
                    ],
                    'genre' => [
                        $genreController = new GenreController(),
                        $genreController->genreAddUpdate(),
                    ],
                    'genre-delete' => [
                        $genreController = new GenreController(),
                        $genreController->genreDelete(),
                    ],
                    'directors' => [
                        $directorController = new DirectorController(),
                        $directorController->directorsList(),
                    ],
                    'director' => [
                        $directorController = new DirectorController(),
                        $directorController->directorAddUpdate(),
                    ],
                    'director-delete' => [
                        $directorController = new DirectorController(),
                        $directorController->directorDelete(),
                    ],
                    'movies' => [
                        $movieController = new MovieController(),
                        $movieController->moviesList(),
                    ],
                    'movie' => [
                        $movieController = new MovieController(),
                        $movieController->movieAddUpdate(),
                    ],
                    'movie-delete' => [
                        $movieController = new MovieController(),
                        $movieController->movieDelete(),
                    ],
                    'reviews' => [
                        $reviewController = new ReviewController(),
                        $reviewController->reviewsList(),
                    ],
                    'review' => [
                        $reviewController = new ReviewController(),
                        $reviewController->reviewAddUpdate(),
                    ],
                    'review-delete' => [
                        $reviewController = new ReviewController(),
                        $reviewController->reviewDelete(),
                    ],
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
