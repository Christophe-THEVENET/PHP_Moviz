<?php

use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use App\Security\Security;
use App\Tools\DateFrench;

$reviewRepository = new ReviewRepository();

require_once _ROOTPATH_ . '/templates/header.php';
/** @var App\Entity\Movie $movie */
?>
<!-- ************************ movie ******************************* -->
<section class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="<?= $movie->getImagePath() ?>" class="d-block mx-lg-auto img-fluid" alt="<?= $movie->getName() ?>" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 show-movie-title"><?= $movie->getName() ?></h1>

        <div class="d-flex">
            <?php foreach ($genres as $genre) {
                /** @var App\Entity\Genre $genre */
            ?><div class="d-flex show-movie-genre"><?= $genre->getName() ?></div>
            <?php } ?>
        </div>
        <h2 class="show-movie-date"> <?php if ($movie->getReleaseYear()) {
                                            $movieDate = $movie->getReleaseYear();
                                            $movieDateFormated = DateFrench::formatDateInFrench($movieDate);
                                            echo $movieDateFormated;
                                        } else {
                                            echo "N/C";
                                        } ?>
        </h2>
        <h2 class="show-movie-duration">Durée: <?php if ($movie->getDuration()) {
                                                    $movieDuration = $movie->getDuration();
                                                    $movieDurationFormated = DateFrench::formatHourInFrench($movieDuration);
                                                    echo $movieDurationFormated;
                                                } else {
                                                    echo "N/C";
                                                } ?>
        </h2>
        <?php foreach ($directors as $director) {
            /** @var App\Entity\Director $director */
        ?> <h2 class="show-movie-director"><?= $director->getFirstName() . " " . $director->getLastName() ?></h2>
        <?php } ?>
        <div>
            <?php
            // étoiles note moyenne du film
            $reviewRatingAverage =  $reviewRepository->getAverageRatingForMovie($movie->getId());
            if ($reviewRatingAverage !== null) {
                $reviewRatingAverageRound = round($reviewRatingAverage);
                $starsHtmlAverage = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $reviewRatingAverageRound) {
                        $starsHtmlAverage .= '<span style="color: gold;">&#9733;</span>'; // Étoile pleine
                    } else {
                        $starsHtmlAverage .= '<span>&#9734;</span>'; // Étoile vide
                    }
                }
            ?>
                <p><?= $starsHtmlAverage ?></p>
            <?php } ?>
        </div>
        <p class="lead"><?= $movie->getSynopsys() ?></p>

</section>

<!-- ************************ formulaire rate ******************************* -->
<?php if (Security::isLogged()) { ?>
    <section class="row flex-lg-row-reverse align-items-start g-5 py-2 w-100 rates-section">

        <h3>Notez ce film :</h3>

        <form method="post" class="form-post-review">
            <label for="rate">Note <span class="rate-span">(cliquez les étoiles)</span></label>
            <fieldset>
                <div class="rate">
                    <input type="radio" id="rate_1" name="rate" value="1">
                    <label for="rate_1">1</label>
                </div>
                <div class="rate">
                    <input type="radio" id="rate_2" name="rate" value="2">
                    <label for="rate_2">2</label>
                </div>
                <div class="rate">
                    <input type="radio" id="rate_3" name="rate" value="3">
                    <label for="rate_3">3</label>
                </div>
                <div class="rate">
                    <input type="radio" id="rate_4" name="rate" value="4">
                    <label for="rate_4">4</label>
                </div>
                <div class="rate">
                    <input type="radio" id="rate_5" name="rate" value="5">
                    <label for="rate_5">5</label>
                </div>
                <!-- données cachées comme le film l'utilisateur -->
                <input type="hidden" name="user_id" value="<?= Security::getCurrentUserId() ?>">
                <input type="hidden" name="movie_id" value="<?= $movie->getId() ?>">
            </fieldset>
            <div>
                <label for="review">Critique</label>
                <textarea id="review" name="review" class="form-control btn-sm"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-outline-primary my-2 btn-sm btn-comments">Envoyer</button>
            </div>
        </form>





    </section>

<?php } else { ?>
    <a href="<?= Security::navigateTo('auth', 'login') ?>" class="nav-link mt-5" aria-current="page">
        <i class="bi bi-box-arrow-in-right me-2"></i>
        Connectez vous pour noter ce film !
    </a>
<?php } ?>

<!-- ************************ all rates for the movie ******************************* -->
<section class="row flex-column align-items-center g-5 py-5 w-100 comments-section">

    <?php
    // récup les commentaires approuvés pour ce film
    $reviewsByMovie = $reviewRepository->findAllByMovieId($movie->getId()); ?>
    <?php
    if (!empty($reviewsByMovie)) { ?>

        <h3>liste des commentaires pour ce film</h3>
    <?php }
    foreach ($reviewsByMovie as $review) {
        // Générez le code HTML pour afficher les étoiles colorées
        $reviewRating =  $review->getRate();
        $starsHtml = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $reviewRating) {
                $starsHtml .= '<span style="color: gold;">&#9733;</span>'; // Étoile pleine
            } else {
                $starsHtml .= '<span>&#9734;</span>'; // Étoile vide
            }
        }

        $userRepository = new UserRepository();
        $user = $userRepository->findOneById($review->getUserId());
        $reviewDate = $review->getCreatedAt();
        $reviewDateFormated = DateFrench::formatDateAdimInFrench($reviewDate);
        $reviewHourFormated = DateFrench::formatHourInFrench($reviewDate);
        $reviewHourFormatedFinal = str_replace(':', 'h', $reviewHourFormated);

    ?>
        <article class='col card-item comments-block'>
            <div class="card w-100">
                <div class="card-body comment-block">
                    <div class="comment-left-block">
                        <h5 class="card-title"><?= $user->getNickname() ?></h5>
                        <div class="user-rating">
                            <p><?= $starsHtml ?> </p>
                            <p><?= $reviewDateFormated ?></p>
                            <p><?= $reviewHourFormatedFinal ?></p>
                        </div>
                    </div>
                    <p class="comment-right-block"><?= $review->getReview() ?></p>
                    <?php
                    if (Security::isMyReview(Security::getCurrentUserId(), $review)) {  ?>
                        <a class="delete-review" data-review-id="<?= $review->getId() ?>"><i class="bi bi-x-square-fill"></i></a>
                    <?php }  ?>
                </div>
            </div>
        </article>

    <?php  } ?>



</section>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>