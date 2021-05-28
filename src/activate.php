<?php
    require "../db_connection.php";
    require "constants.php";
    require "functions.php";
    
    $email = empty($_POST["email"]) ? null : trim($_POST["email"]);
    $activationCode = trim($_POST["n1"] . $_POST["n2"] . $_POST["n3"] . $_POST["n4"] . $_POST["n5"]);

    if (strlen($activationCode) !== 5) {
        $accountActivationErrorMsg = "You entered a non valid code. Try again!";
        header("Location: ../index.php?email=${email}&error=${accountActivationErrorMsg}&form=".ACCOUNT_ACTIVATION_FORM);
        exit;
    }

    if (!$email) {
        // Something went wrong
        header("Location: ../index.php");
        exit;
    }

    try {
        $accountValidationSQL = "SELECT email, activation_code, status FROM users WHERE email=:email AND activation_code=:activation_code";
        $stmt = $pdo->prepare($accountValidationSQL);
        $stmt->execute([
            "email" => $email,
            "activation_code" => $activationCode
        ]);
        $record = $stmt->fetch();
        $stmt->closeCursor();

        if (!$record) {
            $accountActivationErrorMsg = "Wrong Code. Check your email and try again!";
            header("Location: ../index.php?email=${email}&error=${accountActivationErrorMsg}&form=".ACCOUNT_ACTIVATION_FORM);
            exit;
        }

        if ($record["status"] === 1) {
            exit;
        }

        $updateStatusSQL = "UPDATE users SET status = 1 WHERE email=:email";
        $stmt = $pdo->prepare($updateStatusSQL);
        $stmt->execute([
            "email" => $email
        ]);
        $stmt->closeCursor();
        $pdo = null;
        
        header("Location: ../index.php?success=Your account is ready. You can now Sign In!&form=".LOGIN_FORM);
        exit;

    } catch (PDOException $e) {
        $errorMsg = $e->getMessage();
        exit($errorMsg);
    }
    

?>