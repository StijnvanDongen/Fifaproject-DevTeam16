<?php
require "config2.php";
$key = $_GET['key'];
$code = "Yl1EkejMXd";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    die;

} if ($key != $code){
    header('location: ForbiddenPage.php');

} else if ($_SERVER['REQUEST_METHOD'] == "GET"){
    // via get request

    $sql = "SELECT * FROM wedstrijden";
    $query = $db->query($sql);
    $wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($wedstrijden);
}