<?php

use App\Security\Security;
use App\Tools\DateFrench;

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
        <p class="lead"><?= $movie->getSynopsys() ?></p>
    </div>
</section>

<?php if (Security::isLogged()) { ?>
    <!-- ************************ formulaire rate ******************************* -->
    <section class="row flex-lg-row-reverse align-items-start g-5 py-2 w-100 rates-section">

        <h3>Notez ce film :</h3>

        <form action="#" method="post">
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
<section class="row flex-lg-row-reverse align-items-start g-5 py-5 w-100 comments-section">

    <h3>liste des commentaires pour ce film</h3>


    <?php


    // repository
    // Récupérez les données de la note de l'utilisateur depuis la base de données
    // faire la boucle des commentaires 


    $userRating =  5;
    $userName = 'Toto';
    $userDate = "2024-07-17 08:08:48";
    $userDateFormated = DateFrench::formatDateAdimInFrench($userDate);
    $userHourFormated = DateFrench::formatHourInFrench($userDate);
    $userHourFormatedFinal = str_replace(':', 'h', $userHourFormated);

    $userComment = 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor accumsan tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Nulla quis lorem ut libero malesuada feugiat.
Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Nulla porttitor accumsan tincidunt. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.';

    // Générez le code HTML pour afficher les étoiles colorées
    $starsHtml = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $userRating) {
            $starsHtml .= '<span style="color: gold;">&#9733;</span>'; // Étoile pleine
        } else {
            $starsHtml .= '<span>&#9734;</span>'; // Étoile vide
        }
    }

    ?>


    <article class='col card-item comments-block'>
        <div class="card w-100">
            <div class="card-body comment-block">
                <div class="comment-left-block">
                    <h5 class="card-title"><?= $userName ?></h5>
                    <div class="user-rating">
                        <p><?= $starsHtml ?> </p>
                        <p><?= $userDateFormated ?></p>
                        <p><?= $userHourFormatedFinal ?></p>
                    </div>
                </div>
                <p class="comment-right-block"><?= $userComment ?></p>
            </div>
        </div>
    </article>
</section>





<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>