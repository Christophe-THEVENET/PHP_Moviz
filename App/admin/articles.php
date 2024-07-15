<?php
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/articles.php";

if (isset($_GET["page"])) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}

$articles = getArticles($pdo, _ADMIN_ITEM_PER_PAGE_, $page);
$totalArticles = getTotalArticles($pdo);
// 55/10 => 5.5 => 6 (ceil)
$totalPages = ceil($totalArticles / _ADMIN_ITEM_PER_PAGE_);
?>

<h1>Liste des articles</h1>

<!---------------  tableau liste articles -------------- -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) { ?>
            <tr>
                <th scope="row"><?= $article["id"] ?></th>
                <td><?= substr($article["title"], 0, 25) ?></td>
                <td class="logo-article">
                    <a href="article.php<?= $article["id"] ? '?id=' . $article["id"] : '' ?>" class="nav-link" aria-current="page">
                        <i class="bi bi-box-arrow-in-up-left me-2"></i>
                    </a>
                    <a href="article_delete.php<?= $article["id"] ? '?id=' . $article["id"] : '' ?>" class="nav-link" aria-current="page" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                        <i class=" bi bi-x-square me-2"></i>
                    </a>
                </td>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<!----------------------------------------------------- -->


<!--------------------  pagination -------------------- -->
<?php if ($totalPages > 1) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?= ($i === $page) ? "active" : '' ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>
<!----------------------------------------------------- -->


<?php
require_once __DIR__ . "/templates/footer.php";

?>