<?php
// Database parameters
define("host", "localhost");
define("user", "root");
define("password", "");
define("dbname", "dimitris_karakaxas_hotels");
define("dsn", "mysql:host=".host.";dbname=".dbname);

try {
    $pdo = new PDO(dsn, user, password);

    $pdo->exec("set names utf8");
    // Set the PDO error mode to exception mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOEXCEPTION $e) {
    $errorMsg = $e->getMessage();
    die("ERROR: Could not connect. " . $errorMsg);
}

