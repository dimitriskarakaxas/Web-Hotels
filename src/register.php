<?php
require "../db_connection.php";
require "includes.php";


// User Data
$email = trim($_POST["email"]);
$username = trim($_POST["username"]);
$password = $_POST["password"];



// Empty Fields Check
if (empty($email) || empty($username) || empty($password)) {
    $registerErrorMsg = "";
    if (!empty($username) && !empty($password)) {
        $registerErrorMsg = "Please enter your email";
    } else if (!empty($email) && !empty($password)) {
        $registerErrorMsg = "Please enter your username";
    } else if (!empty($email) && !empty($username)) {
        $registerErrorMsg = "Please enter your password";
    } else {
        $registerErrorMsg = "Please fill the form";
    }
    header("Location: ../index.php?error=${registerErrorMsg}&form=".REGISTER_FORM);
    exit();
}

// Username Check
if (preg_match("/\W/", $username)) {
    $registerErrorMsg = "Useraname accepts only characters in [a,z], [A,Z], [1-9] and '_'";
    header("Location: ../index.php?error=${registerErrorMsg}&form=".REGISTER_FORM);
}