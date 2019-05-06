<?php session_start();

$dbHost = 'localhost';
$dbName = 'fifa';
$dbUser = 'root';
$dbPass = '';

// dit zorgt dat je de error berichten goed tezien krijgt

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo " <h1>OEI</h1> de connectie met de database is niet gelukt check je config.php  ";
    die($e->getMessage());
}
