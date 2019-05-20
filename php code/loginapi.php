<?php
require "config2.php";
$key = $_GET['key'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    die;

} else if ($key == "dguaetj9lD" && $_SERVER['REQUEST_METHOD'] == "GET"){
    // via get request

    $sql = "SELECT * FROM users";
    $query = $db->query($sql);
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
}