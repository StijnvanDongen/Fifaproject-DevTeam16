<?php
require "config2.php";
require "header.php";

$sql = "SELECT * FROM wedstrijden";
$query = $db->query($sql);
$wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

$sel = "SELECT wedstrijden.id, teams.teamName FROM wedstrijden 
        inner join teams on wedstrijden.team1 = teams.teamName";
$quary = $db->query($sel);
$teamName = $quary->fetchAll(PDO::FETCH_ASSOC);

foreach ($wedstrijden as $wedstrijd){

    $name = $wedstrijd['team1'];
    $name2 = $wedstrijd['team2'];

    echo "<li><div>{$name} vs {$name2}</div></li>";

}

require "footer.php";