<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'u2709968_Admin');
define('DB_PASSWORD', '545432481373qwe');
define('DB_NAME', 'u2709968_SportComplex');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
?>
