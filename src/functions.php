<?php

function sendFormError($errorMsg, $redirectionForm) {
    header("Location: ../index.php?error=${errorMsg}&form=${redirectionForm}");
    exit;
}

// This function creates an Activation Code that can only have only unique numbers
function generateActivationCode() {
    $activationCode;
    while (true) {
        $activationCode = strval(rand(10000, 99999));
        $instanceCounter = [];
        for ($i = 0; $i < 10; $i++) {
            $instanceCounter[$i] = 0;
        }
        for ($i = 0; $i < strlen($activationCode); $i++) {
           $instanceCounter[$activationCode[$i]]++;
        }
        for ($i = 0; $i < 10; $i++) {
            if ($instanceCounter[$i] >= 2) break;
        }
        if ($i === 10) {
            break;
        }
    }
    return (int)$activationCode;
}

?>