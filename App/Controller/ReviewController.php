<?php

namespace App\Controller;

require_once 'config.php';

use App\Repository\ReviewRepository;
use App\Entity\Review;
use App\Security\Security;

class ReviewController extends Controller
{

    public function reviewsList()
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

                $reviewRepository = new ReviewRepository();
                $reviews = $reviewRepository->findAll(_ADMIN_ITEM_PER_PAGE_, $pages);
            

                $this->render('admin/reviews-list', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'reviews' => $reviews,
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

    public function reviewAddUpdate()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];

                // review vide pour pouvoir afficher ajouter un review
                $review = [
                    'user_id' => '',
                    'movie_id' => '',
                    'rate' => '',
                    'review' => '',
                    'approuved' => '',
                ];

                // ***************** get genre for update ********************
                if (isset($_GET['id'])) {

                    $reviewRepository = new ReviewRepository();
                    $review = $reviewRepository->findOneById((int)$_GET['id']);
               
                    $review = [
                        'id' => $review->getId(),
                        'user_id' => $review->getUserId(),
                        'movie_id' => $review->getMovieId(),
                        'rate' => $review->getRate(),
                        'review' => $review->getReview(),
                        'approuved' => $review->getApprouved(),
                    ];
                                 
                    if ($review === false) {
                        $errors[] = "Le commentaire n\'existe pas";
                    }
                    $pageTitle = "Modifier le commentaire:" . $review['movie_id'];
                } else {
                    $pageTitle = "Ajouter un commentaire";
                }

                // ***************** save review ********************
                if (isset($_POST['saveReview'])) {

                    if (isset($review['id'])) {
                        $_POST['id'] = (int)($review['id']);
                    };

                    $reviewObject = new Review();
                    $reviewObject->hydrate($_POST);
                
                    if (empty($errors)) {
                        $reviewRepository = new ReviewRepository();
                        $reviewRepository->persist($reviewObject);

                        if (isset($review['id'])) {
                            $messages[] = 'Modification du commentaire réussi !';
                            $review = [
                                'user_id' => '',
                                'movie_id' => '',
                                'rate' => '',
                                'review' => '',
                                'approuved' => '',
                            ];
                        } else {
                            $messages[] = 'Ajout du commentaire réussi !';
                        };
                    }
                    $_SESSION['messages'] = $messages;
                    header('location:' . Security::navigateTo('admin', 'reviews'));
                }

                $this->render('admin/review-add-update', [

                    'errors' => $errors,
                    'messages' => $messages,
                    'review' => $review,
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

    public function reviewDelete()
    {
        try {
            if (Security::isLogged() && Security::isAdmin()) {
                $errors = [];
                $messages = [];
                $review = false;

                // ***************** get review for delete ********************
                if (isset($_GET['id'])) {

                    $reviewRepository = new ReviewRepository();
                    $review = $reviewRepository->findOneById($_GET['id']);

                    if ($review === false) {
                        $errors[] = "Le genre n\'existe pas";
                    }
                }

                // ***************** delete review ********************
                if (isset($review)) {

                    $res = $reviewRepository->delete($review);

                    if ($res) {
                        $messages[] = "Le commentaire a bien été supprimé";
                    } else {
                        $errors[] = "Problème pour supprimer le commentaire";
                    }

                    $_SESSION['messages'] = $messages;
                    $_SESSION['errors'] = $errors;
                    header('location:' . Security::navigateTo('admin', 'reviews'));
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
