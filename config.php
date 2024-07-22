<?php
$dbConfig = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/.env');

define("ROLE_USER", "ROLE_USER");
define("ROLE_ADMIN", "ROLE_ADMIN");
define("_DOMAIN_", ".moviz.local");
define("MOVIES_IMAGES_FOLDER", "/uploads/movies/");
define("ASSETS_IMAGES_FOLDER", "/assets/images/");
define("_ADMIN_ITEM_PER_PAGE_", 5);

define("_DB_NAME_", $dbConfig['MYSQL_DATABASE']);
define("_DB_USER_", $dbConfig['MYSQL_USER']);
define("_DB_PASSWORD_", $dbConfig['MYSQL_PASSWORD']);
define("_APP_EMAIL_", "moviz.test@gmail.com");
define("_DB_PORT_", "3306");
define("_DB_HOST_", "db");
