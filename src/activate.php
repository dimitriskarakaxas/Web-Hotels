<?php
    require "constants.php";
    require "functions.php";


    $email = trim($_POST["email"]);
    $n1 = trim($_POST["n1"]);
    $n2 = trim($_POST["n2"]);
    $n3 = trim($_POST["n3"]);
    $n4 = trim($_POST["n4"]);
    $n5 = trim($_POST["n5"]);
    $activationCode = $n1.$n2.$n3.$n4.$n5;

    if (empty($email)) {
        $accountActivationErrorMsg = "Something went wrong!";
        sendFormError($accountActivationErrorMsg, ACCOUNT-ACTIVATION_FORM);
    }

?>