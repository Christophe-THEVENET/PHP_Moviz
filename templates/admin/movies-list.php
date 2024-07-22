<?php

use App\Repository\MovieRepository;
use App\Security\Security;
use App\Tools\DateFrench;

require_once dirname(__DIR__) . "/header.php";

if (isset($_GET["pages"])) {
    $pages = (int)$_GET["pages"];
} else {
    $pages = 1;
}

$movieRepository = new MovieRepository();
$totalMovies = $movieRepository->getTotalMovie();
// 55/10 => 5.5 => 6 (ceil)
$totalPages = ceil($totalMovies / _ADMIN_ITEM_PER_PAGE_);

?>

<section class="w-100 mx-3">
    <div class="admin-title-button">
        <h1>Films</h1>
        <!-- <a href="index.php?controller=admin&action=user"> -->
        <a href="<?= Security::navigateTo('admin', 'movie') ?>">
            <button type="button" class="btn btn-secondary btn-sm">Ajouter un film</button>
        </a>
    </div>

    <?php // ****** success messages ********
    if (isset($_SESSION['messages'])) {
        $messages = $_SESSION['messages'];
        // Display the messages
        foreach ($messages as $key => $message) { ?>
            <div id="message-<?= $key; ?>" class="alert alert-success message">
                <?= $message; ?>
            </div>
    <?php
            unset($_SESSION['messages']);
        }
    } ?>

    <?php // ****** errors messages ********
    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        // Display the messages
        foreach ($errors as $key => $error) { ?>
            <div id="error-<?= $key; ?>" class="alert alert-danger error">
                <?= $error; ?>
            </div>
    <?php
            unset($_SESSION['messages']);
        }
    } ?>

    <!---------------  table movies list -------------- -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titre</th>
                <th scope="col">Date de sortie</th>
                <th scope="col">Synopsys</th>
                <th scope="col">Durée</th>
                <th scope="col">Affiche</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie) {

                $movieDate = $movie->getReleaseYear();
                $movieDateFormated = DateFrench::formatDateAdimInFrench($movieDate);

                $movieDuration = $movie->getDuration();
                $movieDurationFormated = DateFrench::formatHourInFrench($movieDuration);


                /** @var App\Entity\Movie $movie */ ?>
                <tr>
                    <th scope="row"><?= $movie->getId() ?></th>
                    <td><?= $movie->getName() ?></td>
                    <td><?= $movieDateFormated ?></td>
                    <td><?= substr($movie->getSynopsys(), 0, 70) ?></td>
                    <td><?= $movieDurationFormated ?></td>
                    <td><img src="<?= $movie->getImagePath()  ?>" alt="" width="40px"></td>
                    <td class="logo-article">
                        <a href="<?= Security::navigateTo('admin', 'movie') ?><?= $movie->getId() ? '&id=' . $movie->getId() : '' ?>" class="nav-link" aria-current="page">
                            <i class="bi bi-box-arrow-in-up-left me-2"></i>
                        </a>
                        <a href="<?= Security::navigateTo('admin', 'movie-delete') ?><?= $movie->getId() ? '&id=' . $movie->getId() : '' ?>" class="nav-link" aria-current="page" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?')">
                            <i class=" bi bi-x-square me-2"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!--------------------  pagination -------------------- -->
    <?php if ($totalPages > 1) { ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item <?= ($i === $pages) ? "active" : '' ?>">
                        <a class="page-link" href="?controller=admin&action=movies&pages=<?= $i; ?>"><?= $i ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
    <!----------------------------------------------------- -->
</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>