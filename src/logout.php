<?php
    // Open session ...
    session_start();
    // Destroy session
    session_destroy();
    header("Location: ../index.php");
    exit;
?>