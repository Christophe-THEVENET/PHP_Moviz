<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/articles.php";
require_once __DIR__ . "/../lib/category.php";
require_once __DIR__ . "/templates/header.php";

adminOnly();

$article = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $article =  getArticleById($pdo, $_GET["id"]);
}
if ($article) {
    if (deleteArticle($pdo, $_GET["id"])) {
        $messages[] = "L'article a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "L'article n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression article</h1>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>
</div>

<?php
require_once('templates/footer.php');
