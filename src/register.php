<?php

require "../db_connection.php";

$email = trim($_POST["email"]);
$username = trim($_POST["username"]);
$password = $_POST["password"];

if (empty($email) || empty($username) || empty($password)) {
    $registerErrorMsg = "";
    $formType = "Register";
    if (!empty($username) && !empty($password)) {
        $registerErrorMsg = "Please enter your email";
    } else if (!empty($email) && !empty($password)) {
        $registerErrorMsg = "Please enter your username";
    } else if (!empty($email) && !empty($username)) {
        $registerErrorMsg = "Please enter your password";
    } else {
        $registerErrorMsg = "Please fill the form";
    }
    header("Location: ../index.php?error=${registerErrorMsg}&type=${formType}");
}
