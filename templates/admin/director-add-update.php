<?php

require_once dirname(__DIR__) . "/header.php";
/** @var \App\Entity\Director $director */
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
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" class="form-control <?= (isset($errors['first_name']) ? 'is-invalid' : '') ?>" id="first_name" name="first_name" value="<?= $director['first_name'] ?>">
            <?php if (isset($errors['first_name'])) { ?>
                <div class="invalid-feedback"><?= $errors['first_name'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" class="form-control <?= (isset($errors['last_name']) ? 'is-invalid' : '') ?>" id="last_name" name="last_name" value="<?= $director['last_name'] ?>">
            <?php if (isset($errors['last_name'])) { ?>
                <div class="invalid-feedback"><?= $errors['last_name'] ?></div>
            <?php } ?>
        </div>


        <input type="submit" name="saveDirector" class="btn btn-primary btn-sm" <?php if (isset($_GET['id'])) { ?> value="Modifier le réalisateur" <?php } else { ?> value="Ajouter le réalisateur" <?php } ?>>

    </form>

</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>