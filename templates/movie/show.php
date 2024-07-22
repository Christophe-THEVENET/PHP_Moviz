<?php

use App\Tools\DateFrench;

require_once _ROOTPATH_ . '/templates/header.php';

/** @var App\Entity\Movie $movie */
?>


<!-- <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">test</h1> -->


<section class='row d-flex justify-content-center block-show-movie'>
    <div class="container col-xxl-8 px-4 py-5 flux-show-movie">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">

            <div class="col-10 col-sm-8 col-lg-6 show-movie-img">
                <img src="<?= $movie->getImagePath() ?>" class="card-img-top img-card " alt="<?= $movie->getName() ?>"  loading="lazy">
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
            </div>

            <p class="lead"><?= $movie->getSynopsys() ?></p>

        </div>
    </div>
</section>

<h3>a développer le formulaire des commentaires</h3>

<h3>liste des commentaires pour ce film</h3>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>