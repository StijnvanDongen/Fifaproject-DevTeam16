<?php
require "config2.php";
require "header.php";

echo "<h2>Wedstrijdschema:</h2>";

$sql = "SELECT * FROM wedstrijden";
$query = $db->query($sql);
$wedstrijden = $query->fetchAll(PDO::FETCH_ASSOC);

echo"<li class='wedstrijd'>
    <h4>Team 1:</h4>
    <h4>vs</h4>
    <h4>Team 2:</h4>
    <h4>Starttijd:</h4>
    <h4>Speeltijd:</h4>
    <h4>Rusttijd:</h4>
    <h4>Veld:</h4>
</li>";

foreach ($wedstrijden as $wedstrijd){
    $sql = "SELECT * FROM teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $wedstrijd['team1']
    ]);
    $team1 = $prepare->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $wedstrijd['team2']
    ]);
    $team2 = $prepare->fetch(PDO::FETCH_ASSOC);

    $min = $wedstrijd['start'] % 60;
    $hour = ($wedstrijd['start'] - $min) / 60;
    if ( $hour >= 24 ) {
        $hour = $hour - 24;
    }
    if ( $hour < 10 ) {
        $hour = "0" . $hour;
    }
    if ( $min < 10 ) {
        $min = "0" . $min;
    }

    $name = $wedstrijd['id'];

    echo "<li class='wedstrijd'>
        <p>{$team1['teamName']}</p>
        <p> vs </p>
        <p>{$team2['teamName']}</p>
        <p>{$hour}:{$min}</p>
        <p>{$wedstrijd['tijd']} min</p>
        <p>{$wedstrijd['rust']} min</p>
        <p>Veld {$wedstrijd['veld']}</p>
        <p><a href='info.php?id={$wedstrijd['id']}'>info</a></p>
    </li>";


}

require "footer.php";