<?php

use App\Security\Security;
use App\Tools\DateFrench;



require_once dirname(__DIR__) . "/header.php";
?>

<section class="w-100 mx-3">
    <div class="admin-title-button">
        <h1>Utilisateurs</h1>
        <!-- <a href="index.php?controller=admin&action=user"> -->
        <a href="<?= Security::navigateTo('admin', 'user') ?>">
            <button type="button" class="btn btn-secondary btn-sm">Ajouter un utilisateur</button>
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
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                <th scope="col">Crée le</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) {

                $userCreatedAt = $user->getCreatedAt();
                $userCreatedAtFormated = DateFrench::formatDateInFrench($userCreatedAt);
                /** @var App\Entity\User $user */ ?>
                <tr>
                    <th scope="row"><?= $user->getId() ?></th>
                    <td><?= $user->getNickname() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getRoles() ?></td>
                    <td><?= $userCreatedAtFormated ?></td>
                    <td class="logo-article">
                        <a href="<?= Security::navigateTo('admin', 'user') ?><?= $user->getId() ? '&id=' . $user->getId() : '' ?>" class="nav-link" aria-current="page">
                            <i class="bi bi-box-arrow-in-up-left me-2"></i>
                        </a>
                        <a href="<?= Security::navigateTo('admin', 'user-delete') ?><?= $user->getId() ? '&id=' . $user->getId() : '' ?>" class="nav-link" aria-current="page" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
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