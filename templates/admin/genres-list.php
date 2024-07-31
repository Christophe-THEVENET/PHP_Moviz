<?php

use App\Repository\GenreRepository;
use App\Security\Security;

require_once dirname(__DIR__) . "/header.php";

if (isset($_GET["pages"])) {
    $pages = (int)$_GET["pages"];
} else {
    $pages = 1;
}

$genreRepository = new GenreRepository();
$totalGenres = $genreRepository->getTotalGenre();
// 55/10 => 5.5 => 6 (ceil)
$totalPages = ceil($totalGenres / _ADMIN_ITEM_PER_PAGE_);
?>
<section class="w-100 mx-3">
    <div class="admin-title-button">
        <h1>Genres</h1>
        <!-- <a href="index.php?controller=admin&action=user"> -->
        <a href="<?= Security::navigateTo('admin', 'genre') ?>">
            <button type="button" class="btn btn-secondary btn-sm">Ajouter un genre</button>
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

    <!---------------  table genre list -------------- -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($genres as $genre) {
                /** @var App\Entity\Genre $genre */ ?>
                <tr>
                    <th scope="row"><?= $genre->getId() ?></th>
                    <td><?= $genre->getName() ?></td>
                    <td class="logo-article">
                        <a href="<?= Security::navigateTo('admin', 'genre') ?><?= $genre->getId() ? '&id=' . $genre->getId() : '' ?>" class="nav-link" aria-current="page">
                            <i class="bi bi-box-arrow-in-up-left me-2"></i>
                        </a>
                        <a href="<?= Security::navigateTo('admin', 'genre-delete') ?><?= $genre->getId() ? '&id=' . $genre->getId() : '' ?>" class="nav-link" aria-current="page" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
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