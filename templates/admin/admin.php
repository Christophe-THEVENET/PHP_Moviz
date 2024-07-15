<?php

use App\Security\Security;

require_once dirname(__DIR__) . "/header.php";

$userNickname = isset($_SESSION['user']) ? $_SESSION['user']['nickname'] : null;

?>

<section class="w-100 mx-3">

    <h1>Bienvenu <?= $userNickname ?></h1>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos sint laboriosam dicta eum eveniet autem qui? Modi, id saepe dolores obcaecati optio vel quibusdam dicta! Distinctio eius impedit aliquam numquam.</p>
</section>

<?php
require_once dirname(__DIR__) . "/footer.php";
?>