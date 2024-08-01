<?php


$dbConfig = parse_ini_file($_SERVER['DOCUMENT_ROOT']. '/.env');


define("_DB_NAME_", $dbConfig['MYSQL_DATABASE']);
define("_DB_USER_", $dbConfig['MYSQL_USER']);
define("_DB_PASSWORD_", $dbConfig['MYSQL_PASSWORD']);
define("_APP_EMAIL_", "techtrendz.test@gmail.com");