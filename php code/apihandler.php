<?php
require "config2.php";
$key = $_GET['key'];
$code = "RBUUo3AZDy";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    die;

} if ($key != $code){
    header('location: ForbiddenPage.php');

} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // via get request

    $sql = "SELECT * FROM teams";
    $query = $db->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($teams);
}