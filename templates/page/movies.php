<?php

use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php';

$movieRepository = new MovieRepository();
$movies = $movieRepository->findAll();
?>

<h3 class="my-5">N'hésitez pas a poster votre critique !</h3>

<section class="d-flex flex-wrap justify-content-around w-100 mb-5
mt-5 block-movies">
    <?php foreach ($movies as $movie) {
        $genreRepository = new GenreRepository();
        $genres = $genreRepository->findAllByMovieId($movie->getId()); ?>

        <article>
            <a href="<?= Security::navigateTo('movie', 'show') ?><?= $movie->getId() ? '&id=' . $movie->getId() : '' ?>">
                <div class="card " style="width: 20rem;">
                    <img src="<?= $movie->getImagePath() ?>" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
                <div class="d-flex">
                    <?php foreach ($genres as $genre) {
                        /** @var App\Entity\Genre $genre */
                    ?><div class="d-flex show-movie-genre"><?= $genre->getName() ?></div>
                    <?php } ?>
                </div>
                <h3><?= $movie->getName() ?></h3>
                <p class="card-text"><?= substr($movie->getSynopsys(), 0, 100) ?>...</p>
            </div>
            </div>
        </article>

    <?php } ?>
</section>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>