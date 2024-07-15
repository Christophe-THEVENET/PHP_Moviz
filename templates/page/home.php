<?php
require_once _ROOTPATH_ . '/templates/header.php';





?>


<h1>Test : <?= isset($_SESSION['user']) ? $_SESSION['user']['nickname'] : 'Test' ?></h1>




<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>