<?php
require "config2.php";
$key = $_GET['key'];
$code = "RBUUo3AZDy";

$sql = "SELECT * FROM apikeys";
$query = $db->query($sql);
$keys = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        foreach ($keys as $sleuteltje) {

            if ( $sleuteltje['apikey'] == $key ) {

                $sql = "SELECT * FROM teams";
                $query = $db->query($sql);
                $teams = $query->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($teams);
                return;
            }
        }
    }
}