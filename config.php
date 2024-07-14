<?php
$dbConfig = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/.env');

define("ROLE_USER", "ROLE_USER");
define("ROLE_ADMIN", "ROLE_ADMIN");
define("_DOMAIN_", ".moviz.local");
define("_ARTICLES_IMAGES_FOLDER_", "/uploads/articles/");
define("_ASSETS_IMAGES_FOLDER_", "/assets/images/");

define("_DB_NAME_", $dbConfig['MYSQL_DATABASE']);
define("_DB_USER_", $dbConfig['MYSQL_USER']);
define("_DB_PASSWORD_", $dbConfig['MYSQL_PASSWORD']);
define("_APP_EMAIL_", "moviz.test@gmail.com");
define("_DB_PORT_", "3306");
define("_DB_HOST_", "db");
