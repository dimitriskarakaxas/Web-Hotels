<?php

function sendFormError($errorMsg, $redirectionForm) {
    header("Location: ../index.php?error=${errorMsg}&form=${redirectionForm}");
    exit;
}

?>