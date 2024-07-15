<?php

use App\Security\Security;

require_once dirname(__DIR__) . "/header.php";



?>

<?php if (Security::isAdmin()) { ?>
    <section>
        <h1>Bienvenu <?= $userNickname ?></h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos sint laboriosam dicta eum eveniet autem qui? Modi, id saepe dolores obcaecati optio vel quibusdam dicta! Distinctio eius impedit aliquam numquam.</p>
    </section>
<?php } else {
    header("location: /index.php?controller=auth&action=login");
} ?>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>