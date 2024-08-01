<?php

use App\Repository\GenreRepository;
use App\Tools\StringTools;

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

    <form method="POST" enctype="multipart/form-data" class="movie-form">

        <div class="mb-3">
            <label for="name" class="form-label">Titre</label>
            <input type="text" class="form-control <?= (isset($errors['name']) ? 'is-invalid' : '') ?>" id="name" name="name" value="<?= $movie['name'] ?>">
            <?php if (isset($errors['name'])) { ?>
                <div class="invalid-feedback"><?= $errors['name'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="release_year" class="form-label">Date de sortie</label>
            <input placeholder="AAAA-MM-JJ" type="text" class="form-control <?= (isset($errors['release_year']) ? 'is-invalid' : '') ?>" id="release_year" name="release_year" value="<?= $movie['release_year'] ?>">
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
            <input placeholder="HH:MM" type="text" class="form-control <?= (isset($errors['duration']) ? 'is-invalid' : '') ?>" id="duration" name="duration" value="<?= $movie['duration'] ?>">
            <?php if (isset($errors['duration'])) { ?>
                <div class="invalid-feedback"><?= $errors['duration'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <?php if (isset($_GET['id']) && $movie['image_name'] !== '') { ?>
                <p>
                    <img src="<?= MOVIES_IMAGES_FOLDER . $movie['image_name'] ?>" alt="<?= $movie['name'] ?>" width="100">
                    <label for="delete_image">Supprimer l'image</label>
                    <input type="checkbox" name="delete_image" id="delete_image">
                    <input type="hidden" name="image" value="<?= $movie['image_name']; ?>">
                </p>
            <?php } else { ?>
                <p>
                    <img src="<?= ASSETS_IMAGES_FOLDER . 'default-movie.png' ?>" alt="<?= $movie['name'] ?>" width="100">
                </p>
            <?php } ?>
            <p>
                <input type="file" name="file" id="file">
            </p>
        </div>
        <?php
        $genresRepository = new GenreRepository();
        $genresAll = $genresRepository->findAll();
        ?>

        <p class="genre-title">Genres:</p>
        <?php  // Iterate through the array of checkbox objects
        foreach ($genresAll as $checkboxObject) {
            // Check if the checkbox object is present in the array of item objects
            $isChecked = false;
            foreach ($genresByMovie as $itemObject) {
                if ($checkboxObject->getId() == $itemObject->getId()) {
                    $isChecked = true;
                    break;
                }
            }
            echo '<div class="form-check form-switch">';
            echo '<input class="form-check-input" role="switch" type="checkbox" name="options[]" value="' . $checkboxObject->getId() . '"' . ($isChecked ? ' checked' : '') . '>';
            echo '<label class="form-check-label">' . $checkboxObject->getName() . '</label>';
            echo '</div>';
        } ?>

        <p class="director-title">Réalisateurs: </p>
        <!-- ******************** réalisateurs ****************************** -->
        <?php foreach ($directorsByMovie as $director) {  ?>
            <div class="d-flex directors-block">
                <div class="mb-3">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" class="form-control <?= (isset($errors['first_name']) ? 'is-invalid' : '') ?>" id="first_name" name="first_name[]" value="<?= $director->getFirstName() ?>">
                    <?php if (isset($errors['first_name'])) { ?>
                        <div class="invalid-feedback"><?= $errors['first_name'] ?></div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="text" class="form-control <?= (isset($errors['last_name']) ? 'is-invalid' : '') ?>" id="last_name" name="last_name[]" value="<?= $director->getLastName() ?>">
                    <?php if (isset($errors['first_name'])) { ?>
                        <div class="invalid-feedback"><?= $errors['last_name'] ?></div>
                    <?php } ?>
                </div>

                <input type="hidden" name="director_id" value="<?= $director->getId() ?>">
                <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
                <a class="delete-link"><i class="bi bi-x-square-fill"></i></a>
            </div>


        <?php } ?>
        <input id="add-director" type="button" value="Ajouter un réalisateur" class="btn btn-outline-primary btn-sm">
        <!-- **************************************************************** -->

        <input type="submit" name="saveMovie" class="btn btn-primary btn-sm" <?php if (isset($_GET['id'])) { ?> value="Modifier le film" <?php } else { ?> value="Ajouter le film" <?php } ?>>

    </form>

</section>

<?php

require_once dirname(__DIR__) . "/footer.php";
?>