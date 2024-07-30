<?php

use App\Repository\MovieRepository;
use App\Repository\UserRepository;

require_once dirname(__DIR__) . "/header.php";
/** @var \App\Entity\Review $review */
/** @var \App\Entity\User $user */
/** @var \App\Entity\Movie $movie */

$userRepository = new UserRepository();
$movieRepository = new MovieRepository();

$userId = $review['user_id'];
$movieId = $review['movie_id'];

$user = $userRepository->findOneById($userId);
$movie = $movieRepository->findOneById($movieId);




?>
<section class="w-100 mx-3">

    <h1><?= $pageTitle; ?></h1>

    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success">
            <?= $message; ?>
        </div>
    <?php } ?>

    <form method="POST" class="movie-form">

        <div class="mb-3">
            <label for="user_id" class="form-label">Utilisateur</label>
            <input type="text" class="form-control <?= (isset($errors['user_id']) ? 'is-invalid' : '') ?>" id="user_id" name="user_id" value="<?= $user->getNickname() ?>">
            <?php if (isset($errors['user_id'])) { ?>
                <div class="invalid-feedback"><?= $errors['user_id'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="movie_id" class="form-label">Film</label>
            <input type="text" class="form-control <?= (isset($errors['movie_id']) ? 'is-invalid' : '') ?>" id="movie_id" name="movie_id" value="<?= $movie->getName() ?>">
            <?php if (isset($errors['movie_id'])) { ?>
                <div class="invalid-feedback"><?= $errors['movie_id'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Note</label>
            <input type="text" class="form-control <?= (isset($errors['rate']) ? 'is-invalid' : '') ?>" id="rate" name="rate" value="<?= $review['rate'] ?>">
            <?php if (isset($errors['rate'])) { ?>
                <div class="invalid-feedback"><?= $errors['rate'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Commentaire</label>
            <textarea class="form-control  <?= (isset($errors['review']) ? 'is-invalid' : '') ?>" id="review" name="review" value="<?= $review['review'] ?>" rows="10" name="review" id="review"><?= $review['review'] ?></textarea>
            <?php if (isset($errors['review'])) { ?>
                <div class="invalid-feedback"><?= $errors['review'] ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="approuved" class="form-label">Approuvé</label>
            <input class="form-check-input" role="switch" type="checkbox" name="approuved" value="<?= $review['approuved'] ? 'checked' : '' ?>">
            <?php if (isset($errors['approuved'])) { ?>
                <div class="invalid-feedback"><?= $errors['approuved'] ?></div>
            <?php } ?>
        </div>
          


        <input id="add-director" type="button" value="Ajouter un réalisateur" class="btn btn-outline-primary btn-sm">
        <!-- **************************************************************** -->


        <input type="submit" name="saveReview" class="btn btn-primary btn-sm" <?php if (isset($_GET['id'])) { ?> value="Modifier le commentaire" <?php } else { ?> value="Ajouter le commentaire" <?php } ?>>

    </form>

</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>