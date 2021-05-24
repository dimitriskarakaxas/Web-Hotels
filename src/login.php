<?php

// require "db_connection.php";
require "includes.php";

$username = trim($_POST["username"]);
$password = $_POST["password"];

if (empty($password) || empty($username)) {
    $loginErrorMsg = "";
    if (!empty($password)) {
       $loginErrorMsg = "Please enter your username";
    } else if (!empty($username)) {
        $loginErrorMsg = "Please enter your password";
    } else {
        $loginErrorMsg = "Please fill the form";
    }
    header("Location: ../index.php?error=${loginErrorMsg}&form=".LOGIN_FORM);
}

?>
