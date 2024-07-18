<?php

use App\Security\Security;

require_once dirname(__DIR__) . "/header.php";
?>

<section class="w-100 mx-3">
    <div class="admin-title-button">
        <h1>directors</h1>
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
</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>