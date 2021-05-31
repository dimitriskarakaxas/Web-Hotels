<?php 
$userIsLoggedIn = false;
if (isset($_SESSION["username"])) {
    $userIsLoggedIn = true;
}
?>