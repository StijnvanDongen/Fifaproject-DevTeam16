<?php
require "config2.php";
$key = $_GET['key'];
$code = "Yl1EkejMXd";

$sql = "SELECT * FROM apikeys";
$query = $db->query($sql);
$keys = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        foreach ($keys as $sleuteltje) {

            if ($sleuteltje['apikey'] == $key) {

                $sql = "SELECT * FROM wedstrijden";
                $query = $db->query($sql);
                $wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($wedstrijden);
                return;
            }
        }
    }
}