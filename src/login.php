<?php
session_start();
require "../db_connection.php";
require "constants.php";
require "functions.php";

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
    exit;
}

try {
    $checkUserSQL = "SELECT userid, username, password, status FROM users WHERE username=:username";
    $stmt = $pdo->prepare($checkUserSQL);
    $stmt->execute([
        "username" => $username
    ]);
    
    // Check if user exists
    if (!$stmt->rowCount()) {
        $loginErrorMsg = "There is no user with this username!";
        sendFormError($loginErrorMsg, LOGIN_FORM);
    }

    $userRecord = $stmt->fetch();
    $stmt->closecursor();

    // Check if account is innactive
    if ($userRecord["status"] === INACTIVATED_ACCOUNT) {
        $loginErrorMsg = "Your acount is not active!";
        sendFormError($loginErrorMsg, ACCOUNT_ACTIVATION_FORM);
    }

    // Check if password is not correct
    if (crypt($password, $userRecord["password"]) !== $userRecord["password"]) {
        $loginErrorMsg = "Wrong password. Try again!";
        sendFormError($loginErrorMsg, LOGIN_FORM);
    }


    // Logging in user
    $_SESSION["username"] = $userRecord["username"];
    header("Location: ../index.php");
    exit;


} catch (PDOException $e) {
    $errorMsg = $e->getMessage();
    exit($errorMsg);
}

?>
