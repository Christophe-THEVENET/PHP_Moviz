<?php

require_once 'config.php';
require_once dirname(__DIR__) . '/header.php';

/** @var \App\Entity\User $user */
?>

<h1><?= $pageTitle; ?></h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success">
        <?= $message; ?>
    </div>
<?php } ?>

<form method="POST">

    <div class="mb-3">
        <label for="nickname" class="form-label">Pseudo</label>
        <input type="text" class="form-control <?= (isset($errors['nickname']) ? 'is-invalid' : '') ?>" id="nickname" name="nickname" value="">
        <?php if (isset($errors['nickname'])) { ?>
            <div class="invalid-feedback"><?= $errors['nickname'] ?></div>
        <?php } ?>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?= (isset($errors['email']) ? 'is-invalid' : '') ?>" id="email" name="email" value="">
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

    <input type="submit" name="saveUser" class="btn btn-primary btn-sm" value="S'inscrire">

</form>


<?php require_once dirname(__DIR__) . '/footer.php'; ?>