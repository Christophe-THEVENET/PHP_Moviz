<?php

use App\Security\Security;

require_once dirname(__DIR__) . '/header.php'; ?>

<h1>Connexion</h1>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
<?php } ?>

<form method="POST">
    <div class="mb-3">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <input type="submit" name="loginUser" class="btn btn-primary btn-sm" value="Se connecter">
</form>
<a href="<?= Security::navigateTo('user', 'register') ?>" class="nav-link mt-5" aria-current="page">
    <i class="bi bi-person-fill-add me-2"></i>
    Pas de compte, inscrivez-vous ici !
</a>

<?php require_once dirname(__DIR__) . '/footer.php'; ?>