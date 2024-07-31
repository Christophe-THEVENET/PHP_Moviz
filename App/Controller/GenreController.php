<?php

namespace App\Controller;

require_once 'config.php';

use App\Repository\GenreRepository;
use App\Entity\Genre;
use App\Security\Security;

class GenreController extends Controller
{
    
    public function genresList()
    {
        if (isset($_GET["pages"])) {
            $pages = (int)$_GET["pages"];
        } else {
            $pages = 1;
        }
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                $GenreRepository = new GenreRepository();
                $genres = $GenreRepository->findAll(_ADMIN_ITEM_PER_PAGE_, $pages);

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

                    echo '<pre>';
                    print_r($genre);
                    echo '</pre>';
                    die;
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
