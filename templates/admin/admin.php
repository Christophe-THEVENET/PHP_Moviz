<?php

use App\Repository\UserRepository;

require_once dirname(__DIR__) . "/header.php";

$userNickname = isset($_SESSION['user']) ? $_SESSION['user']['nickname'] : null;

$userRepository = new UserRepository();

$totalUsers = $userRepository->getTotalUser(); 
?>

<section class="w-100 mx-3">
    <h1>Bienvenu <?= $userNickname ?></h1>
    <p>Il y a actuellement <?= $totalUsers ?> utilisateurs inscrits sur le site</p>
</section>

<?php


require_once dirname(__DIR__) . "/footer.php";
?>