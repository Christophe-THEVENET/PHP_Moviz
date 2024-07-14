<?php require_once _ROOTPATH_ . '/templates/header.php'; 



?>




<h1>Test : <?= $_SESSION['user']['nickname'] ? $_SESSION['user']['nickname'] : 'Test' ?></h1>
<h2><?= $nom; ?></h2>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>