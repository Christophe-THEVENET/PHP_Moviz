<?php

namespace App\Controller;

require_once 'config.php';

use App\Repository\MovieRepository;
use App\Entity\Movie;
use App\Repository\DirectorRepository;
use App\Repository\GenreRepository;
use App\Security\Security;
use App\Tools\FileTools;

class MovieController extends Controller
{

    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                match ($_GET['action']) {
                    'show' =>  $this->show(),
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

    protected function show()
    {
        try {
            if (isset($_GET['id'])) {
                // Récupérer le film avec le Repository
                $movieRepository = new MovieRepository();
                $id = (int)$_GET['id'];
                $movie = $movieRepository->findOneById($id);

                if ($movie) {
                    $genreRepository = new GenreRepository();
                    $genres = $genreRepository->findAllByMovieId($movie->getId());

                    $directorRepository = new DirectorRepository();
                    $directors = $directorRepository->findAllByMovieId($movie->getId());

                    $this->render('movie/show', [
                        'movie' => $movie,
                        'genres' => $genres,
                        'directors' => $directors,
                    ]);
                } else {
                    throw new \Exception("Ce film n'existe pas");
                }
            } else {
                throw new \Exception("L'id est manquant en paramètre d'url");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function moviesList()
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

                $movieRepository = new MovieRepository();
                $movies = $movieRepository->findAll(_ADMIN_ITEM_PER_PAGE_, $pages);


                $this->render('admin/movies-list', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'movies' => $movies,
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

    public function movieAddUpdate()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                // user vide pour pouvoir afficher ajouter un film
                $movie = [
                    'name' => '',
                    'release_year' => '',
                    'synopsys' => '',
                    'duration' => '',
                    'image_name' => 'null',

                ];

                // ***************** get movie for update ********************
                if (isset($_GET['id'])) {

                    $id = (int)$_GET['id'];

                    $movieRepository = new movieRepository();
                    $movie = $movieRepository->findOneById($id);

                    $genreRepository = new GenreRepository();
                    $genres = $genreRepository->findAllByMovieId($movie->getId());

                    $directorRepository = new DirectorRepository();
                    $directors = $directorRepository->findAllByMovieId($movie->getId());

                    $movie = [
                        'id' => $movie->getId(),
                        'name' => $movie->getName(),
                        'release_year' => $movie->getReleaseYear(),
                        'synopsys' => $movie->getSynopsys(),
                        'duration' => $movie->getDuration(),
                        'image_name' => $movie->getImageName(),
                    ];
         
                                 
                    if ($movie === false) {
                        $errors[] = "Le film n\'existe pas";
                    }
                    $pageTitle = "Modifier le film : " . $movie['name'];
                } else {
                    $pageTitle = "Ajouter un film";
                }


                // ***************** save movie ********************
                if (isset($_POST['saveMovie'])) {

                    // donne un id a la fct hydrate qui update sinon elle crée
                    if (isset($movie['id'])) {
                        $_POST['id'] = $movie['id'];

                    };

                    // si un fichier est envoyé 
                    if ((isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '')) {

                        $filename = FileTools::uploadImage(MOVIES_IMAGES_FOLDER, $_FILES['file'], $movie['image_name']);
                        $_POST['image_name'] = $filename['fileName'];
                    } else {
                        // Si aucun fichier n'a été envoyé
                        if (isset($_GET['id'])) {
                            // si on a coché supp image
                            if (isset($_POST['delete_image'])) {
                                // Si on a coché la case de suppression d'image, on supprime l'image
                                unlink(dirname(dirname(__DIR__)) . MOVIES_IMAGES_FOLDER . $movie['image_name']);
                                $movie['image_name'] = '';
                            } else {
                                $_POST['image_name'] = $movie['image_name'];
                            }
                        }
                    }
                       

              
                    $movieObject = new movie();
                    $movieObject->hydrate($_POST);


                    if (empty($errors)) {
                        $movieRepository = new movieRepository();
                        $movieRepository->persist($movieObject);

                        if (isset($movie['id'])) {
                            $messages[] = 'Modification du film réussi !';
                            $movie = [
                                'id' => '',
                                'first_name' => '',
                                'last_name' => '',

                            ];
                        } else {
                            $messages[] = 'Ajout du film réussi !';
                        };
                    }
                    $_SESSION['messages'] = $messages;
                    header('location:' . Security::navigateTo('admin', 'movies'));
                }


                $this->render('admin/movie-add-update', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'movie' => $movie,
                    'pageTitle' => $pageTitle,
                    'genres' => $genres,
                    'directors' => $directors,
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

    public function movieDelete()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];
                $movie = false;


                // ***************** get user for delete ********************
                if (isset($_GET['id'])) {

                    $movieRepository = new movieRepository();
                    $movie = $movieRepository->findOneById($_GET['id']);

                    if ($movie === false) {
                        $errors[] = "Le réalisateur n\'existe pas";
                    }
                }

                // ***************** delete user ********************
                if (isset($movie)) {

                    $res = $movieRepository->delete($movie);

                    if ($res) {
                        $messages[] = "Le réalisateur a bien été supprimé";
                    } else {
                        $errors[] = "Problème pour supprimer le réalisateur";
                    }


                    $_SESSION['messages'] = $messages;
                    $_SESSION['errors'] = $errors;
                    header('location:' . Security::navigateTo('admin', 'movies'));
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
