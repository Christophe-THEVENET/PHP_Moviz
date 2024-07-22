<?php

require_once dirname(__DIR__) . "/header.php";
/** @var \App\Entity\Movie $movie */
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
            <label for="name" class="form-label">Titre</label>
            <input type="text" class="form-control <?= (isset($errors['name']) ? 'is-invalid' : '') ?>" id="name" name="name" value="<?= $movie['name'] ?>">
            <?php if (isset($errors['name'])) { ?>
                <div class="invalid-feedback"><?= $errors['name'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="release_year" class="form-label">Date de sortie</label>
            <input type="text" class="form-control <?= (isset($errors['release_year']) ? 'is-invalid' : '') ?>" id="release_year" name="release_year" value="<?= $movie['release_year'] ?>">
            <?php if (isset($errors['release_year'])) { ?>
                <div class="invalid-feedback"><?= $errors['release_year'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="synopsys" class="form-label">Synopsys</label>
            <textarea class="form-control  <?= (isset($errors['synopsys']) ? 'is-invalid' : '') ?>" id="synopsys" name="synopsys" value="<?= $movie['synopsys'] ?>" rows="10" name="synopsys" id="synopsys"><?= $movie['synopsys'] ?></textarea>
            <?php if (isset($errors['synopsys'])) { ?>
                <div class="invalid-feedback"><?= $errors['synopsys'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Durée</label>
            <input type="text" class="form-control <?= (isset($errors['duration']) ? 'is-invalid' : '') ?>" id="duration" name="duration" value="<?= $movie['duration'] ?>">
            <?php if (isset($errors['duration'])) { ?>
                <div class="invalid-feedback"><?= $errors['duration'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Image</label>

            <?php if (isset($_GET['id']) && isset($movie['image_name'])) { ?>
                <p>
                    <img src="<?= MOVIES_IMAGES_FOLDER . $movie['image_name'] ?>" alt="<?= $movie['name'] ?>" width="100">
                    <label for="delete_image">Supprimer l'image</label>
                    <input type="checkbox" name="delete_image" id="delete_image">
                    <input type="hidden" name="image" value="<?= $movie['image_name']; ?>">
                </p>
            <?php } ?>
            <p>
                <input type="file" name="file" id="file">
            </p>
        </div>

        <?php foreach ($genres as $genre) { ?>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control <?= (isset($errors['genre']) ? 'is-invalid' : '') ?>" id="genre" name="genre" value="<?= $genre->getName() ?>">
                <?php if (isset($errors['genre'])) { ?>
                    <div class="invalid-feedback"><?= $genre->getName() ?></div>
                <?php } ?>
            </div>
        <?php   } ?>





        <input type="submit" name="saveMovie" class="btn btn-primary btn-sm" <?php if (isset($_GET['id'])) { ?> value="Modifier le film" <?php } else { ?> value="Ajouter le film" <?php } ?>>

    </form>

</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>