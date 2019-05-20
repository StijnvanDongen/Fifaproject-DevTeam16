<?php
require "config2.php";
$key = $_GET['key'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    die;

} else if ($key == "Yl1EkejMXd" && $_SERVER['REQUEST_METHOD'] == "GET"){
    // via get request

    $sql = "SELECT * FROM wedstrijden";
    $query = $db->query($sql);
    $wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($wedstrijden);
}