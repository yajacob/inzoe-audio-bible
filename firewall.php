<?php
session_start();

$SS_username = strtoupper($_SESSION["username"]);
if ($SS_username == "") {
    header("Location: /login.php");
    exit;
}
?>