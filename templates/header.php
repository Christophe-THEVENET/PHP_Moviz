<?php

use App\Security\Security;
use App\Tools\NavigationTools;

require_once _ROOTPATH_ . '/config.php';

$userNickname = isset($_SESSION['user']) ? $_SESSION['user']['nickname'] : null;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Moviz</title>
</head>

<body>

    <div class="container">

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="/" class="nav-link px-2 ">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="/?controller=movie&action=list" class="nav-link px-2 ">Les films</a>
                </li>
            </ul>
            <div class="col-md-4 d-flex justify-content-end align-items-baseline">

                <?php if (Security::isLogged()) { ?>
                    <span class="m-2">Bienvenue <?= $userNickname ?></span>
                    <a href="/index.php?controller=auth&action=logout" class="btn btn-primary btn-sm m-1">Déconnexion</a>
                    <?php if (Security::isAdmin()) { ?>
                        <a href="/index.php?controller=admin&action=admin" class="btn btn-outline-primary me-2 btn-sm m-1 <?= NavigationTools::addActiveClass('asmin', 'admin') ?>">Administration</a>
                    <?php }
                } else { ?>
                    <a href="/index.php?controller=auth&action=login" class="btn btn-outline-primary me-2 btn-sm <?= NavigationTools::addActiveClass('auth', 'login') ?>">Connexion</a>
                    <a href="/index.php?controller=user&action=register" class="btn btn-outline-primary me-2 btn-sm <?= NavigationTools::addActiveClass('user', 'register') ?>">Inscription</a>
                <?php } ?>
            </div>

        </header>

        <!--  display flex sur les pages admin pour la sidebar a gauche -->
        <main class=" admin-container <?= Security::isAdmin() ? 'd-flex align-items-around ' : '' ?>">
            <?php

            // ********************************** si admin => sidebar **********************************
            if (isset($_GET['controller']) && $_GET['controller'] == 'admin') { ?>
                <!-- ------------   sidebar ---------------- -->
                <div class="sidebar__title  d-flex flex-column flex-shrink-0 p-3 m-2 text-bg-dark" style="width: 220px;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4 sidebar__title">Administration</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="<?= Security::navigateTo('page', 'home') ?>" class="nav-link <?= NavigationTools::addActiveClass('page', 'home') ?>" aria-current="page">
                                <i class="bi bi-gear-wide me-2"></i>
                                Acceuil site
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Security::navigateTo('admin', 'admin') ?>" class="nav-link <?= NavigationTools::addActiveClass('admin', 'admin') ?>" aria-current="page">
                                <i class="bi bi-house me-2"></i>
                                Acceuil admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Security::navigateTo('admin', 'users') ?>" class="nav-link <?= NavigationTools::addActiveClass('admin', 'users') ?>" aria-current="page">
                                <i class="bi bi-house me-2"></i>
                                Utilisateurs
                            </a>
                        </li>



                        <li>
                            <a href="" class="nav-link  <?= basename($_SERVER['SCRIPT_NAME']) === 'articles.php' ? 'active' : "" ?>">
                                <i class="bi-table bi pe-none me-2"></i>
                                Articles
                            </a>
                        </li>
                        <li>
                            <a href="/app/admin/article.php" class="nav-link  <?= basename($_SERVER['SCRIPT_NAME']) === 'article.php' ? 'active' : "" ?>">
                                <i class="bi bi-plus-square-fill pe-none me-2"></i>
                                Ajouter un article
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <?php if (Security::isAdmin()) { ?>
                        <div class="dropdown">
                            <a href="#" class="d-flex  align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                <strong> <?= $userNickname ?> </strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= Security::navigateTo('auth', 'logout') ?>">Sign out</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            <?php }
