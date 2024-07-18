<?php

namespace App\Controller;

require_once 'config.php';

use App\Repository\GenreRepository;
use App\Entity\Genre;
use App\Security\Security;

class GenreController extends Controller
{
    /*  public function route(): void
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
    } */

    /* protected function register()
    {
        try {
            $errors = [];
            $messages = [];
            $genre = new User();
            $genreValidator = new UserValidator();

            if (isset($_POST['saveUser'])) {

                $genre->hydrate($_POST);
                $genre->setRoles(ROLE_USER);

                $errors = $genreValidator->validate($genre);

                if (empty($errors)) {
                    $GenreRepository = new GenreRepository();

                    $GenreRepository->persist($genre);
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
    } */

    public function genresList()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                $GenreRepository = new GenreRepository();
                $genres = $GenreRepository->findAll();

                $this->render('admin/genres-list', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'genres' => $genres,
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

    public function genreAddUpdate()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                // user vide pour pouvoir afficher ajouter un user
                $genre = [
                    'name' => '',
                ];

                // ***************** get genre for update ********************
                if (isset($_GET['id'])) {

                    $genreRepository = new GenreRepository();
                    $genre = $genreRepository->findOneById($_GET['id']);

                    $genre = [
                        'id' => $genre->getId(),
                        'name' => $genre->getName(),
                    ];

                    if ($genre === false) {
                        $errors[] = "Le genre n\'existe pas";
                    }
                    $pageTitle = "Modifier le genre:" . $genre['name'];
                } else {
                    $pageTitle = "Ajouter un genre";
                }


                // ***************** save genre ********************
                if (isset($_POST['saveGenre'])) {

                    if (isset($genre['id'])) {
                        $_POST['id'] = $genre['id'];
                    };

                    $genreObject = new Genre();
                    $genreObject->hydrate($_POST);


                    if (empty($errors)) {
                        $GenreRepository = new GenreRepository();
                        $GenreRepository->persist($genreObject);

                        if (isset($genre['id'])) {
                            $messages[] = 'Modification de genre réussi !';
                            $genre = [
                                'id' => '',
                                'name' => '',

                            ];
                        } else {
                            $messages[] = 'Ajout de genre réussi !';
                        };
                    }
                    $_SESSION['messages'] = $messages;
                    header('location:' . Security::navigateTo('admin', 'genres'));
                }


                $this->render('admin/genre-add-update', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'user' => $genre,
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

    public function genreDelete()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];
                $genre = false;


                // ***************** get user for delete ********************
                if (isset($_GET['id'])) {

                    $GenreRepository = new GenreRepository();
                    $genre = $GenreRepository->findOneById($_GET['id']);

                    if ($genre === false) {
                        $errors[] = "Le genre n\'existe pas";
                    }
                }

                // ***************** delete user ********************
                if (isset($genre)) {

                    $res = $GenreRepository->delete($genre);

                    if ($res) {
                        $messages[] = "Le genre a bien été supprimé";
                    } else {
                        $errors[] = "Problème pour supprimer le genre";
                    }


                    $_SESSION['messages'] = $messages;
                    $_SESSION['errors'] = $errors;
                    header('location:' . Security::navigateTo('admin', 'genres'));
                }
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
