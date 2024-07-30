<?php

use App\Repository\ReviewRepository;
use App\Security\Security;

require_once dirname(__DIR__) . "/header.php";

use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Tools\DateFrench;

/** @var \App\Entity\Review $review */
/** @var \App\Entity\User $user */
/** @var \App\Entity\Movie $movie */

$userRepository = new UserRepository();
$movieRepository = new MovieRepository();




if (isset($_GET["pages"])) {
    $pages = (int)$_GET["pages"];
} else {
    $pages = 1;
}

$reviewRepository = new ReviewRepository();
$totalReviews = $reviewRepository->getTotalReview();
// 55/10 => 5.5 => 6 (ceil)
$totalPages = ceil($totalReviews / _ADMIN_ITEM_PER_PAGE_);
?>

<section class="w-100 mx-3">
    <div class="admin-title-button">
        <h1>Commentaires</h1>
        <!-- <a href="index.php?controller=admin&action=user"> -->
        <a href="<?= Security::navigateTo('admin', 'review') ?>">
            <button type="button" class="btn btn-secondary btn-sm">Ajouter un commentaire</button>
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

    <!---------------  table review list -------------- -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Film</th>
                <th scope="col">Note</th>
                <th scope="col">Commentaire <span class="span-hover">(survol)</span></th>
                <th scope="col">Crée le</th>
                <th scope="col">Approuvé</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review) {


                $userId = $review->getUserId();
                $movieId = $review->getMovieId();

                $user = $userRepository->findOneById($userId);
                $movie = $movieRepository->findOneById($movieId);

                $commentCreatedAt = $review->getCreatedAt();
                $commentCreatedAtFormated = DateFrench::formatDateInFrench($commentCreatedAt);

                /** @var App\Entity\Review $review */ ?>
                <tr>




                    <th scope="row"><?= $review->getId() ?></th>
                    <td><?= $user->getNickname() ?></td>
                    <td><?= $movie->getName() ?></td>
                    <td><?= $review->getRate() ?></td>
                    <td class="review-case">
                        <?= substr(htmlspecialchars($review->getReview()), 0, 50) ?>
                        <div class="tooltip"><?= htmlspecialchars($review->getReview()) ?></div>
                    </td>
                    <td><?= $commentCreatedAtFormated ?></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" role="checkbox" data-id="<?= htmlspecialchars($review->getId()) ?>" type="checkbox" name="approuved" value="<?= $review->getApprouved() ?>" <?= $review->getApprouved() === 0 ? '' : 'checked' ?>>
                        </div>
                    </td>
                    <td class="logo-article">
                        <a href="<?= Security::navigateTo('admin', 'review') ?><?= $review->getId() ? '&id=' . $review->getId() : '' ?>" class="nav-link" aria-current="page">
                            <i class="bi bi-box-arrow-in-up-left me-2"></i>
                        </a>
                        <a href="<?= Security::navigateTo('admin', 'review-delete') ?><?= $review->getId() ? '&id=' . $review->getId() : '' ?>" class="nav-link" aria-current="page" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet commentaire ?')">
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
                        <a class="page-link" href="?controller=admin&action=genres&pages=<?= $i; ?>"><?= $i ?></a>
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