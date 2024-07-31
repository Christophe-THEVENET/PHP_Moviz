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
            <input readonly type="hidden" class="form-control <?= (isset($errors['user_id']) ? 'is-invalid' : '') ?>" id="user_id" name="user_id" value="<?= $review['user_id'] ?>">
            <?php if (isset($errors['user_id'])) { ?>
                <div class="invalid-feedback"><?= $errors['user_id'] ?></div>
            <?php } ?>
            <p class="form-control"><?= $user->getNickname() ?></p>
        </div>
        <div class=" mb-3">
            <label for="movie_id" class="form-label">Film</label>
            <input readonly type="hidden" class="form-control <?= (isset($errors['movie_id']) ? 'is-invalid' : '') ?>" id="movie_id" name="movie_id" value="<?= $review['movie_id'] ?>">
            <?php if (isset($errors['movie_id'])) { ?>
                <div class="invalid-feedback"><?= $errors['movie_id'] ?></div>
            <?php } ?>
            <p class="form-control"><?= $movie->getName() ?></p>

        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Note</label>
            <input readonly type="hidden" class="form-control <?= (isset($errors['rate']) ? 'is-invalid' : '') ?>" id="rate" name="rate" value="<?= $review['rate'] ?>">
            <?php if (isset($errors['rate'])) { ?>
                <div class="invalid-feedback"><?= $errors['rate'] ?></div>
            <?php } ?>
            <p class="form-control"><?= $review['rate'] ?></p>

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
            <input class="form-check-input" role="switch" type="checkbox" name="approuved" value="1" <?= $review['approuved'] !== 0 ? 'checked' : '' ?>>
            <?php if (isset($errors['approuved'])) { ?>
                <div class="invalid-feedback"><?= $errors['approuved'] ?></div>
            <?php } ?>
        </div>



        <input type="submit" name="saveReview" class="btn btn-primary btn-sm" <?php if (isset($_GET['id'])) { ?> value="Modifier le commentaire" <?php } else { ?> value="Ajouter le commentaire" <?php } ?>>

    </form>

</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>