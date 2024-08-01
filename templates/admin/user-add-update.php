<?php

require_once dirname(__DIR__) . "/header.php";
/** @var \App\Entity\User $user */
?>

<section class="w-100 mx-3">

    <h1><?= $pageTitle; ?></h1>

    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success">
            <?= $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label for="nickname" class="form-label">Pseudo</label>
            <input type="text" class="form-control <?= (isset($errors['nickname']) ? 'is-invalid' : '') ?>" id="nickname" name="nickname" value="<?= $user['nickname'] ?>">
            <?php if (isset($errors['nickname'])) { ?>
                <div class="invalid-feedback"><?= $errors['nickname'] ?></div>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= (isset($errors['email']) ? 'is-invalid' : '') ?>" id="email" name="email" value="<?= $user['email'] ?>">
            <?php if (isset($errors['email'])) { ?>
                <div class="invalid-feedback"><?= $errors['email'] ?></div>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control <?= (isset($errors['password']) ? 'is-invalid' : '') ?>" id="password" name="password" value="">
            <?php if (isset($errors['password'])) { ?>
                <div class="invalid-feedback"><?= $errors['password'] ?></div>
            <?php } ?>
        </div>

        <div class="mb-3">
            <label for="roles" class="form-label">Role</label>
            <select name="roles" id="roles" class="form-select">
                <option value="ROLE_USER" <?= $user['roles'] === "ROLE_USER" ?  "selected" : ''  ?><?= !$user['roles']  ??  "selected"   ?>><?= ROLE_USER ?></option>
                <option value="ROLE_ADMIN" <?= $user['roles'] === "ROLE_ADMIN" ?  "selected" : ''  ?>><?= ROLE_ADMIN ?></option>
            </select>
        </div>

        <input type="submit" name="saveUser" class="btn btn-primary btn-sm" <?php if (isset($_GET['id'])) { ?> value="Modifier l'utilisateur" <?php } else { ?> value="Ajouter l'utilisateur" <?php } ?>>

    </form>
    <!---------------  table users list -------------- -->

</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>