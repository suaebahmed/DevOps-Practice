<?php
$mysqli = new mysqli("mysql", "user", "password", "db");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
