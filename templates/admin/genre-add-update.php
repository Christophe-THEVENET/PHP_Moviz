<?php

require_once dirname(__DIR__) . "/header.php";
/** @var \App\Entity\Genre $genre */
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
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control <?= (isset($errors['name']) ? 'is-invalid' : '') ?>" id="name" name="name" value="<?= $genre['name'] ?>">
            <?php if (isset($errors['name'])) { ?>
                <div class="invalid-feedback"><?= $errors['name'] ?></div>
            <?php } ?>
        </div>
     

        <input type="submit" name="saveGenre" class="btn btn-primary btn-sm" <?php if (isset($_GET['id'])) { ?> value="Modifier le genre" <?php } else { ?> value="Ajouter le genre" <?php } ?>>

    </form>

</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>