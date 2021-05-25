<?php
require "../db_connection.php";
require "includes.php";
require "functions.php";


// User Data
$email = trim($_POST["email"]);
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);



// Empty Fields Check
if (empty($email) || empty($username) || empty($password)) {
    $registerErrorMsg = "";
    if (!empty($username) && !empty($password)) {
        $registerErrorMsg = "Please enter your email!";
    } else if (!empty($email) && !empty($password)) {
        $registerErrorMsg = "Please enter your username!";
    } else if (!empty($email) && !empty($username)) {
        $registerErrorMsg = "Please enter your password!";
    } else {
        $registerErrorMsg = "Please fill the form!";
    }
    sendFormError($registerErrorMsg, REGISTER_FORM);
}



// Email Check
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $registerErrorMsg = "Your email is not Valid!";
    sendFormError($registerErrorMsg, REGISTER_FORM);
}

// Username Check
if (preg_match("/\W/", $username) || strlen($username) > 25) {
    $registerErrorMsg = "";
    if (strlen($username) > 25) {
        $registerErrorMsg = "Username shouldn't be more than 25 characters!";
    } else {
        $registerErrorMsg = "Useraname accepts only characters in [a,z], [A,Z], [1-9] and '_'!";
    }
    sendFormError($registerErrorMsg, REGISTER_FORM);
}

// Password Check
if (preg_match("/\W/", $password) || strlen($password) < 8) {
    $registerErrorMsg = "";
    if (strlen($password) < 8) {
        $registerErrorMsg = "Password should be more than 8 characters!";
    } else {
        $registerErrorMsg = "Your Password is not valid!";
    }
    sendFormError($registerErrorMsg, REGISTER_FORM);
}

// reCAPTCHA Check
if (isset($_POST["g-recaptcha-response"])) {
    $captcha = $_POST["g-recaptcha-response"];
}

if (!$captcha) {
    $registerErrorMsg = "Please confirm that you are not a robot!";
    sendFormError($registerErrorMsg, REGISTER_FORM);
}


$secretKey = RECAPTCHA_KEY_SERVER_SIDE;
$userIP = $_SERVER["REMOTE_ADDR"];
$url = "https://www.google.com/recaptcha/api/siteverify?secret=".urlencode($secretKey)."&response=".urlencode($captcha)."&remoteip=".urlencode($userIP);

// post request to server
$response = file_get_contents($url);

// Convert Google's API RESPONSE from Object to an ASSOC ARRAY
$responseKeys = json_decode($response, true);

if (!$responseKeys["success"]) {
    // Spammer trying to create account
    exit();
}


try {

    $emailSQL = "SELECT email FROM users WHERE email=:email";
    $stmt = $pdo->prepare($emailSQL);
    $stmt->execute(
        [":email" => $email]
    );
    
    if ($stmt->rowCount()) {
        $registerErrorMsg = "This Email is already in use";
        sendFormError($registerErrorMsg, REGISTER_FORM);
    }


    $usernameSQL = "SELECT username FROM users WHERE username=:username";
    $stmt = $pdo->prepare($usernameSQL);
    $stmt->execute(
        [":username" => $username]
    );

    if ($stmt->rowCount()) {
        $registerErrorMsg = "This Username is already in use";
        sendFormError($registerErrorMsg, REGISTER_FORM);
    }
    

    
} catch (PDOException $e) {
    $errorMsg = $e->getMessage();
    die("ERROR: Something went wrong. " . $errorMsg);
}






