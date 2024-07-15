<?php


require_once dirname(__DIR__) . "/header.php";


?>

<section class="w-100 mx-3">
    <div class="admin-title-button">
        <h1>Utilisateurs</h1>
        <button type="button" class="btn btn-secondary">Ajouter un utilisateur</button>
    </div>


    <!---------------  table users list -------------- -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) {
                /** @var App\Entity\User $user */ ?>
                <tr>
                    <th scope="row"><?= $user->getId() ?></th>
                    <td><?= $user->getNickname() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getRoles() ?></td>
                    <td class="logo-article">
                        <a href="article.php<?= $user->getId() ? '?id=' . $user->getId() : '' ?>" class="nav-link" aria-current="page">
                            <i class="bi bi-box-arrow-in-up-left me-2"></i>
                        </a>
                        <a href="article_delete.php<?= $user->getId() ? '?id=' . $user->getId() : '' ?>" class="nav-link" aria-current="page" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
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