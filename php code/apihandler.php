<?php
require "config2.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    die;

} else if ($_SERVER['REQUEST_METHOD'] == "GET"){
    // via get request

    $sql = "SELECT * FROM teams";
    $query = $db->query($sql);
    $teams = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($teams);



    $sql = "SELECT * FROM users";
    $query = $db->query($sql);
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
}

