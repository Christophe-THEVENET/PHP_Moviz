<?php

use App\Repository\DirectorRepository;
use App\Security\Security;

require_once dirname(__DIR__) . "/header.php";

if (isset($_GET["pages"])) {
    $pages = (int)$_GET["pages"];
} else {
    $pages = 1;
}

$directorRepository = new DirectorRepository();
$totalDirectors = $directorRepository->getTotalDirector();
// 55/10 => 5.5 => 6 (ceil)
$totalPages = ceil($totalDirectors / _ADMIN_ITEM_PER_PAGE_);
?>

<section class="w-100 mx-3">
    <div class="admin-title-button">
        <h1>Réalisateurs</h1>
        <!-- <a href="index.php?controller=admin&action=user"> -->
        <a href="<?= Security::navigateTo('admin', 'director') ?>">
            <button type="button" class="btn btn-secondary btn-sm">Ajouter un réalisateur</button>
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

    <!---------------  table users list -------------- -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($directors as $director) {

                /** @var App\Entity\Director $director */ ?>
                <tr>
                    <th scope="row"><?= $director->getId() ?></th>
                    <td><?= $director->getFirstName() ?></td>
                    <td><?= $director->getLastName() ?></td>
                    <td class="logo-article">
                        <a href="<?= Security::navigateTo('admin', 'director') ?><?= $director->getId() ? '&id=' . $director->getId() : '' ?>" class="nav-link" aria-current="page">
                            <i class="bi bi-box-arrow-in-up-left me-2"></i>
                        </a>
                        <a href="<?= Security::navigateTo('admin', 'director-delete') ?><?= $director->getId() ? '&id=' . $director->getId() : '' ?>" class="nav-link" aria-current="page" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
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
                        <a class="page-link" href="?controller=admin&action=directors&pages=<?= $i; ?>"><?= $i ?></a>
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