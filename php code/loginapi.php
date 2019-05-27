<?php
require "config2.php";
$key = $_GET['key'];
$code = "dguaetj9lD";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    die;

} if ($key != $code){
    header('location: ForbiddenPage.php');

} else if ($_SERVER['REQUEST_METHOD'] == "GET"){
    // via get request

    $sql = "SELECT * FROM users";
    $query = $db->query($sql);
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
}