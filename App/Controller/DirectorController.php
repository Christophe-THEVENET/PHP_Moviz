<?php

namespace App\Controller;

require_once 'config.php';

use App\Repository\DirectorRepository;
use App\Entity\Director;
use App\Security\Security;

class DirectorController extends Controller
{
    
    public function directorsList()
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

                $directorRepository = new DirectorRepository();
                $directors = $directorRepository->findAll(_ADMIN_ITEM_PER_PAGE_, $pages);

                $this->render('admin/directors-list', [

                    'errors' => $errors,
                    'messages' => $messages,
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

    public function directorAddUpdate()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                // user vide pour pouvoir afficher ajouter un user
                $director = [
                    'first_name' => '',
                    'last_name' => '',
                ];

                // ***************** get director for update ********************
                if (isset($_GET['id'])) {

                    $directorRepository = new DirectorRepository();
                    $director = $directorRepository->findOneById($_GET['id']);

                    $director = [
                        'id' => $director->getId(),
                        'first_name' => $director->getFirstName(),
                        'last_name' => $director->getLastName(),
                    ];

                    if ($director === false) {
                        $errors[] = "Le réalisateur n\'existe pas";
                    }
                    $pageTitle = "Modifier le réalisateur:" . $director['first_name']. ' ' . $director['last_name'] ;
                } else {
                    $pageTitle = "Ajouter un réalisateur";
                }


                // ***************** save director ********************
                if (isset($_POST['saveDirector'])) {

                    if (isset($director['id'])) {
                        $_POST['id'] = $director['id'];
                    };

                    $directorObject = new Director();
                    $directorObject->hydrate($_POST);


                    if (empty($errors)) {
                        $directorRepository = new DirectorRepository();
                        $directorRepository->persist($directorObject);

                        if (isset($director['id'])) {
                            $messages[] = 'Modification du réalisateur réussi !';
                            $director = [
                                'id' => '',
                                'first_name' => '',
                                'last_name' => '',

                            ];
                        } else {
                            $messages[] = 'Ajout du réalisateur réussi !';
                        };
                    }
                    $_SESSION['messages'] = $messages;
                    header('location:' . Security::navigateTo('admin', 'directors'));
                }


                $this->render('admin/director-add-update', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'director' => $director,
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

    public function directorDelete()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];
                $director = false;


                // ***************** get user for delete ********************
                if (isset($_GET['id'])) {

                    $directorRepository = new DirectorRepository();
                    $director = $directorRepository->findOneById($_GET['id']);

                    if ($director === false) {
                        $errors[] = "Le réalisateur n\'existe pas";
                    }
                }

                // ***************** delete user ********************
                if (isset($director)) {

                    $res = $directorRepository->delete($director);

                    if ($res) {
                        $messages[] = "Le réalisateur a bien été supprimé";
                    } else {
                        $errors[] = "Problème pour supprimer le réalisateur";
                    }


                    $_SESSION['messages'] = $messages;
                    $_SESSION['errors'] = $errors;
                    header('location:' . Security::navigateTo('admin', 'directors'));
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
