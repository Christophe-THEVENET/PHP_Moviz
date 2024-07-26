<?php

use App\Tools\DateFrench;

require_once _ROOTPATH_ . '/templates/header.php';

/** @var App\Entity\Movie $movie */
?>


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

<section class="row flex-lg-row-reverse align-items-start g-5 py-5 w-100">

    <h3>Notez ce film :</h3>

    <form action="#" method="post">
        <fieldset>
            <legend>Note</legend>
            <div class="rate">
                <input type="radio" id="rate_5" name="rate" value="5">
                <label for="rate_5">5</label>
            </div>
            <div class="rate">
                <input type="radio" id="rate_4" name="rate" value="4">
                <label for="rate_4">4</label>
            </div>
            <div class="rate">
                <input type="radio" id="rate_3" name="rate" value="3">
                <label for="rate_3">3</label>
            </div>
            <div class="rate">
                <input type="radio" id="rate_2" name="rate" value="2">
                <label for="rate_2">2</label>
            </div>
            <div class="rate">
                <input type="radio" id="rate_1" name="rate" value="1">
                <label for="rate_1">1</label>
            </div>
        </fieldset>
        <div>
            <label for="review">Critique</label>
            <textarea id="review" name="review" class="form-control"></textarea>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>



</section>

<section class="row flex-lg-row-reverse align-items-start g-5 py-5 w-100">

    <h3>liste des commentaires pour ce film</h3>
    <article class='colcard-item px-5 py-2'>
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">test</h5>


                <div class="row align-items-center">
                    <div class="rate col-6">
                        <input disabled="disabled" type="radio" id="avgstar{{ i }}-{{reviewByMovie.user.email}}" name="avgrate{{i}}-{{reviewByMovie.user.email}}" value="" <?php 'toto' ? 'checked="checked"' : '' ?> />
                        <label for="avgstar{{ i }}-{{reviewByMovie.user.email}}" title="">test étoiles</label>

                    </div>
                    <p class="card-text">test</p>
                </div>
            </div>
    </article>
</section>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>