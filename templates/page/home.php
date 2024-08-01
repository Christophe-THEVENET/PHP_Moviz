<?php

use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php';

$movieRepository = new MovieRepository();
$moviesForHome = $movieRepository->findAll(_ITEM_PER_HOME_PAGE_);
?>

<section class="row flex-lg-row-reverse align-items-center g-5 banniere">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="<?= ASSETS_IMAGES_FOLDER . '/movie-banniere.png' ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Bienvenue sur notre site de critique de films.</h1>
        <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        </div>
    </div>
</section>

<h3 class="my-5">Derniers films notés:</h3>

<section class="d-flex flex-wrap justify-content-around w-100 mb-5">
    <?php foreach ($moviesForHome as $movie) {
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